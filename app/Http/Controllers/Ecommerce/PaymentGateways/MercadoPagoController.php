<?php

namespace App\Http\Controllers\Ecommerce\PaymentGateways;

use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MercadoPagoController extends Controller
{
    public static function payment(Request $request){
        $paymentId = $request->data['id'];

        $response = Http::get(config('services.mercadopago.url').'payments/'.$paymentId.'?access_token='.config('services.mercadopago.token'));
        $response = json_decode($response);

        $paymentStatus = $response->status; //'pending', 'inprocess', 'inmediation', 'approved', 'cancelled', 'refunded', 'chargedback'
        $paymentMethod = $response->payment_method_id.'-'.$response->payment_type_id;
        $orderNumber = $response->external_reference;
        $orderPaymentStatus = Order::PAYMENT_STATUS_REJECTED;

        if(!in_array($paymentStatus, ['pending', 'inprocess', 'inmediation'])):
            $orderPaymentStatus = Order::PAYMENT_STATUS_REJECTED;
        endif;
        if(in_array($paymentStatus, ['approved'])):
            $orderPaymentStatus = Order::PAYMENT_STATUS_APPROVED;
        endif;

        $order = Order::where('number', $orderNumber)->first();

        if($order && $order->payment_status != Order::PAYMENT_STATUS_APPROVED):
            $order->payment_status = $orderPaymentStatus;
            $order->payment_id = $paymentId;
            $order->payment_method = 'MercadoPago'.'-'.$paymentMethod;
            $order->payment_data = json_encode($response);
            $order->update();
            if($response->status == 'approved'):
                CheckoutController::processOrder($order);
            endif;
        endif;

        return [
            'paymentId' => $paymentId,
            'paymentStatus' => $paymentStatus,
            'orderPaymentStatus' => $orderPaymentStatus,
            'number' => $orderNumber
        ];
    }
}
