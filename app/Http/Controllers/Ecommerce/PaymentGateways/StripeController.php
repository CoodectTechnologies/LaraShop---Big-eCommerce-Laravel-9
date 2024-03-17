<?php

namespace App\Http\Controllers\Ecommerce\PaymentGateways;

use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public static function payment(Request $request){
        $paymentId = $request['data']['object']['payment_intent'];
        $orderNumber = $request['data']['object']['metadata']['external_reference'];
        $paymentStatus = $request['data']['object']['payment_status']; //paid, unpaid, no_payment_required

        $stripe = new StripeClient(config('services.stripe.secret'));
        $response = $stripe->paymentIntents->retrieve($paymentId, []);

        $paymentMethod = $response->payment_method_types[0];
        $orderPaymentStatus = Order::PAYMENT_STATUS_PENDING;

        if(in_array($paymentStatus, ['paid'])):
            $orderPaymentStatus = Order::PAYMENT_STATUS_APPROVED;
        endif;

        $order = Order::where('number', $orderNumber)->first();

        if($order && $order->payment_status != Order::PAYMENT_STATUS_APPROVED):
            $order->payment_status =  $orderPaymentStatus;
            $order->payment_method = 'Stripe'.'-'.$paymentMethod;
            $order->payment_data = json_encode($response);
            $order->update();
            if($paymentStatus == 'paid'):
                CheckoutController::processOrder($order);
            endif;
        endif;

        return [
            'paymentId' => $paymentId,
            'paymentStatus' => $paymentStatus,
            'orderPaymentStatus' => $orderPaymentStatus,
            'number' => $orderNumber,
        ];
    }
}
