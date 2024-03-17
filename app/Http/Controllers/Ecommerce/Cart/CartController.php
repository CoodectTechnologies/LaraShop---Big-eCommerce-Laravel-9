<?php

namespace App\Http\Controllers\Ecommerce\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        return view('ecommerce.cart.index');
    }
    public static function store(Product $product, $qty, $price, $options = []){
        if(!isset($options['type'])):
            $type = $product->getType();
            if($type == Product::TYPE_PHYSICAL_AND_DIGITAL):
                $type = Product::TYPE_PHYSICAL;
            endif;
            $options['type'] = $type;
        endif;
        if(!isset($options['image'])):
            $options['image'] = $product->imagePreview();
        endif;
        if(!isset($options['price'])):
            $options['price'] = $product->getPriceFinal();
        endif;
        if(!self::validateVariation($product, $options)):
            return Redirect::route('ecommerce.product.show', $product);
        endif;
        if(!self::validateStock($product, $qty, 'store', $options)) return false;
        $options['currency'] = Session::get('currency');
        $options['price'] = round($options['price'], 2);
        $price = round($price, 2);
        $priceWholesale = self::priceWholesale($product, $qty, $options['price']);
        $price = ($price - $priceWholesale);
        Cart::instance('default')->add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $price,
            'options' => $options
        ])->associate(Product::class);
        self::saveSession();
        Session::flash('alert', $product->name.' '.__('added'));
        Session::flash('alert-type', 'success');
        return true;
    }
    public static function update($product, $rowId, $qty){
        $cart = Cart::instance('default')->get($rowId);
        if(!self::validateStock($product, $qty, 'update', $cart->options)) return false;
        $priceWholesale = self::priceWholesale($product, $qty, $cart->options->price);
        $price = ($cart->options->price - $priceWholesale);
        Cart::instance('default')->update($rowId, ['qty' => $qty, 'price' => $price]);
        self::saveSession();
        Session::flash('alert', __('The article was successfully updated'));
        Session::flash('alert-type', 'success');
        return true;
    }
    public static function destroy($rowId){
        if(!$rowId):
            Cart::instance('default')->destroy();
            self::saveSession();
            Session::flash('alert', __('Cart removed'));
            Session::flash('alert-type', 'success');
        else:
            Cart::instance('default')->remove($rowId);
            self::saveSession();
            Session::flash('alert', __('Article was successfully removed'));
            Session::flash('alert-type', 'success');
        endif;
    }
    private static function validateVariation($product, $options){
        $validateVariation = true;
        //Validar que se hayan seleccionado las variaciones que tiene el producto
        $size = null;
        $color = null;
        $type = null;
        if(isset($options['size']['id'])):
            $size = ProductSize::with('productColors')->find($options['size']['id']);
        endif;
        if(isset($options['color']['id'])):
            $color = ProductColor::with('productSizes')->find($options['size']['id']);
        endif;
        $type = $options['type'];
        if(
            ($product->productSizes()->count() && !isset($options['size']['id']) && $type == Product::TYPE_PHYSICAL) ||
            ($product->productColors()->count() && !isset($options['color']['id']) && ($size ? $size->relation_with_colors == 'SI' : true) && $type == Product::TYPE_PHYSICAL) ||
            ($product->type == Product::TYPE_PHYSICAL_AND_DIGITAL && !$type)
        ):
            Session::flash('alert', __('This product has variations, please select the options indicated'));
            Session::flash('alert-type', 'warning');
            return $validateVariation = false;
        endif;
        //Validar que las variaciones de color y medida sean correspondientes a sus relacion
        if(
            ($product->productSizes()->count() && isset($options['size']['id']) && $type == Product::TYPE_PHYSICAL) &&
            ($product->productColors()->count() && isset($options['color']['id']) && $type == Product::TYPE_PHYSICAL)
        ):
            $size = ProductSize::find($options['size']['id']);
            $color = ProductColor::find($options['color']['id']);
            if(
                !$size->validateSizeColorSelected($color->id) ||
                !$color->validateColorSizeSelected($size->id)
            ):
                Session::flash('alert', __('The relationships between colors and measurements do not correspond.'));
                Session::flash('alert-type', 'warning');
                return $validateVariation = false;
            endif;
        endif;
        return $validateVariation;
    }
    private static function validateStock($product, $qtyToAdd, $method, $options){
        $validateStock = true;
        $sizeId = null;
        $colorId = null;
        $type = null;
        $quantity = $product->quantity;
        if(isset($options['size']['id']) && $options['size']['id']):
            $size = ProductSize::with('productColors')->find($options['size']['id']);
            $sizeId = $size->id;
            $quantity = $size->quantity;
        endif;
        if(isset($options['color']['id']) && $options['color']['id']):
            $color = ProductColor::with('productSizes')->find($options['color']['id']);
            $colorId = $color->id;
            $quantity = $color->quantity;
        endif;
        if(
            isset($options['size']['id']) && $options['size']['id'] &&
            isset($options['color']['id']) && $options['color']['id']
        ):
            if($size->relation_with_colors != 'SI'):
                $quantity = $size->quantity;
            else:
                $sizeColor = $size->productColors->where('id', $color->id)->first();
                if($sizeColor):
                    $quantity = $sizeColor->pivot->quantity;
                endif;
            endif;
        endif;
        $type = $options['type'];
        if($type == Product::TYPE_DIGITAL):
            $qtyToAdd = 1;
        endif;
        if($method == 'store'):
            //Obtenemos el mismo producto del carrito en caso de que existe en el carrito
            $cartItems = Cart::instance('default')->search(function ($cartItem) use($product) {
                return $cartItem->id === $product->id;
            });
            //Si existe en el carrito entonces obtenemos cuantos ya existen en el carrito
            if($cartItems->isNotEmpty()):
                foreach($cartItems as $cartItem):
                    $sizeOptionId = null;
                    $colorOptionId = null;
                    if(isset($cartItem->options['size']['id']) && $cartItem->options['size']['id']):
                        $sizeOptionId = $cartItem->options['size']['id'];
                    endif;
                    if(isset($cartItem->options['color']['id']) && $cartItem->options['color']['id']):
                        $colorOptionId = $cartItem->options['color']['id'];
                    endif;
                    $typeOption = $cartItem->options['type'];
                    if(
                        $sizeId == $sizeOptionId &&
                        $colorId == $colorOptionId &&
                        $typeOption == $type
                    ):
                        $qtyToAdd += $cartItem->qty;
                    endif;
                endforeach;
            endif;
        endif;
        $validateStock = $quantity !== null ? ($quantity >= $qtyToAdd) : true;
        if(!$validateStock):
            Session::flash('alert', __('Stock limit exceeded, maximun:').' '.$quantity);
            Session::flash('alert-type', 'warning');
        endif;
        return $validateStock;
    }
    private static function priceWholesale($product, $qty, $price){
        $priceWholesale = 0;
        if($wholesale = $product->getWholesale()):
            $wholesale->load('wholesaleDetails');
            foreach($wholesale->wholesaleDetails as $wholesaleDetail):
                if (in_array($qty, range($wholesaleDetail->qty_from, $wholesaleDetail->qty_to))):
                    $priceWholesale = ($price * $wholesaleDetail->percentage / 100);
                    break;
                endif;
            endforeach;
        endif;
        return $priceWholesale;
    }
    private static function saveSession(){
        if(Auth::check()):
            Cart::instance('default')->store(Auth::id());
        endif;
    }
}
