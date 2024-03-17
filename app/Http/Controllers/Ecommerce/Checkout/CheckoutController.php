<?php

namespace App\Http\Controllers\Ecommerce\Checkout;

use App\Notifications\Order\OrderCreate as NotificationOrderCreate;
use Illuminate\Support\Facades\Notification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use App\Mail\Order\OrderChangeStatus;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\Order\OrderInfoBank;
use App\Mail\Order\OrderCreate;
use App\Models\ProductColor;
use Illuminate\Support\Str;
use App\Models\ProductSize;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Exception;

class CheckoutController extends Controller
{
    public function index(){
        if(!Cart::instance('default')->count()):
            return Redirect::route('ecommerce.product.index');
        endif;
        return view('ecommerce.checkout.index');
    }
    public function payment(Order $order){
        if(in_array($order->payment_status, ['Aprobado', 'Rechazado'])):
            return Redirect::route('ecommerce.checkout.complete', $order);
        endif;
        $order->load(['products', 'shippingAddress.state.country']);
        return view('ecommerce.checkout.payment', compact('order'));
    }
    public function complete(Order $order){
        return view('ecommerce.checkout.complete', compact('order'));
    }
    public function whatsapp(){
        //GRETING
        $orderToString = '*Hola buen día, necesito cotización completa para este listado de productos, muchas gracias.*'.PHP_EOL;
        $orderToString .= '--------------------------------'.PHP_EOL;
        //STRING CONTENT CART
        foreach (Cart::instance('default')->content() as $item) {
            $orderToString .= '* '.$item->name.' ('.route('ecommerce.product.show', $item->model).') '.PHP_EOL;
        }
        $orderToString .= PHP_EOL.'--------------------------------'.PHP_EOL;
        //STRING SUMMARY
        $orderToString .= '*Subtotal: $'.number_format(str_replace(',', '', Cart::subtotal()), 2).'*'.PHP_EOL;
        return Redirect::to('https://wa.me/'.config('contact.whatsapp').'?text='.rawurlencode($orderToString));
    }
    public static function decrementStock($order, $reverse = false){
        $order->load('products');
        if($order->payment_status == 'Aprobado' || $reverse):
            foreach ($order->products as $product):
                if($product->pivot->type == Product::TYPE_PHYSICAL):
                    if(
                        $product->pivot->product_size_id &&
                        $product->pivot->product_color_id
                    ):
                        //Decrementamos la cantidad de la variante relacionada
                        $productSizeId = $product->pivot->product_size_id;
                        $productColorId = $product->pivot->product_color_id;
                        $size = ProductSize::with('productColors')->find($productSizeId);
                        $sizeColor = $size->productColors()->where('product_color_id', $productColorId)->first();
                        if($sizeColor):
                            $sizeColorQuantity = $sizeColor->pivot->quantity;
                            if($reverse):
                                $size->productColors()->updateExistingPivot($productColorId, [
                                    'quantity' => ($sizeColorQuantity + $product->pivot->quantity),
                                ]);
                            else:
                                $size->productColors()->updateExistingPivot($productColorId, [
                                    'quantity' => ($sizeColorQuantity - $product->pivot->quantity),
                                ]);
                            endif;
                        endif;
                    elseif($productSizeId = $product->pivot->product_size_id):
                        //Decrementamos la cantidad de la medida
                        $productSize = ProductSize::find($productSizeId);
                        if($reverse):
                            $productSize->update(['quantity' => ($productSize->quantity + $product->pivot->quantity)]);
                        else:
                            $productSize->update(['quantity' => ($productSize->quantity - $product->pivot->quantity)]);
                        endif;
                    elseif($productColorId = $product->pivot->product_color_id):
                        //Decrementamos la cantidad del color
                        $productColor = ProductColor::find($productColorId);
                        if($reverse):
                            $productColor->update(['quantity' => ($productColor->quantity + $product->pivot->quantity)]);
                        else:
                            $productColor->update(['quantity' => ($productColor->quantity - $product->pivot->quantity)]);
                        endif;
                    else:
                        //Decrementamos la cantidad al producto original
                        if($product->quantity !== null): //null == ilimitado
                            continue;
                        endif;
                        if($reverse):
                            $product->update(['quantity' => ($product->quantity + $product->pivot->quantity)]);
                        else:
                            $product->update(['quantity' => ($product->quantity - $product->pivot->quantity)]);
                        endif;
                    endif;
                endif;
            endforeach;
        endif;
    }
    public static function sendEmail($order){
        try{
            $order->shippingAddress->email = 'rigoberto.villa42@gmail.com';
            Mail::to($order->shippingAddress->email)->send(new OrderCreate($order));
            $order->send_email = true;
            $order->update();
        }catch(Exception $e){
            $order->send_email = false;
            $order->send_email_error = $e->getMessage();
            $order->update();
        }
    }
    public static function sendEmailStatus($order){
        try{
            Mail::to($order->shippingAddress->email)->send(new OrderChangeStatus($order));
        }catch(Exception $e){}
    }
    public static function sendEmailInfoBank($order){
        try{
            Mail::to($order->shippingAddress->email)->send(new OrderInfoBank($order));
            $order->send_email = true;
            $order->update();
        }catch(Exception $e){
            $order->send_email = false;
            $order->send_email_error = $e->getMessage();
            $order->update();
        }
    }
    public static function sendNotificationAdmin($order){
        try{
            Notification::send(User::permission(['ordenes'])->get(), new NotificationOrderCreate($order));
        }catch(Exception $e){}
    }
    public static function processOrder($order){
        self::decrementStock($order);
        self::sendEmail($order);
        self::sendNotificationAdmin($order);
    }
    public static function generateOrderNumber(){
        $preffix = "P-";
        $number = $preffix."00000001";
        $lastOrderNumber = Order::max('number');
        if($lastOrderNumber):
            if(Str::contains($lastOrderNumber, $preffix)):
                $number = intval(explode($preffix, $lastOrderNumber)[1]);
                $number++;
                $number = str_pad($number, 8, "0", STR_PAD_LEFT);
                $number = $preffix.$number;
            endif;
        endif;
        return $number;
    }
}
