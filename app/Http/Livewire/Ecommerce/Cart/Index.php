<?php

namespace App\Http\Livewire\Ecommerce\Cart;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Models\Product;
use App\Models\ShippingZone;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Index extends Component
{
    public function render(){
        $cart = Cart::instance('default')->content();
        $subtotal = Cart::subtotal();
        $getShippingZonesFreeShippingOverTo = $this->getShippingZonesFreeShippingOverTo();
        return view('livewire.ecommerce.cart.index', compact('cart', 'subtotal', 'getShippingZonesFreeShippingOverTo'));
    }
    public function update($productId, $rowId, $qty){
        $product = Product::findOrFail($productId);
        $updateCart = CartController::update($product, $rowId, $qty);
        if($updateCart):
            $this->emitTo('ecommerce.layouts.cart', 'render');
        endif;
    }
    public function delete($rowId){
        CartController::destroy($rowId);
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
    public function deleteCart(){
        Cart::instance('default')->destroy();
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
    private function getShippingZonesFreeShippingOverTo(){
        $shippingZones = [];
        if($this->loadShippingApplies()):
            $shippingZones = ShippingZone::whereNotNull('free_shipping_over_to')->get();
        endif;
        return $shippingZones;
    }
    private function loadShippingApplies(){
        $shippingApplies = false;
        foreach (Cart::instance('default')->content() as $item):
            if($item->options->type == Product::TYPE_PHYSICAL):
                $shippingApplies = true;
                break;
            endif;
        endforeach;
        return $shippingApplies;
    }
}
