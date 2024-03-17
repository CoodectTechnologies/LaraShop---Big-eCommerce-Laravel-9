<?php

namespace App\Http\Livewire\Ecommerce\Checkout;

use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use Illuminate\Support\Facades\Redirect;
use MercadoPago\Preference;
use MercadoPago\Shipments;
use Stripe\StripeClient;
use Livewire\Component;
use MercadoPago\Item;
use App\Models\Order;
use MercadoPago\SDK;

class Payment extends Component
{
    public $order;
    public $currency;

    public function mount(Order $order){
        $this->order = $order;
        $this->loadCurrency();
    }
    public function render(){
        $mercadoPago = $this->loadMercadoPago();
        $stripeURL = $this->loadStripe();
        return view('livewire.ecommerce.checkout.payment', compact('mercadoPago', 'stripeURL'));
    }
    private function loadCurrency(){
        $this->currency = strtoupper($this->order->currency);
    }
    public function paymentPayPal($data){
        $data = json_decode(json_encode($data));
        $this->order->payment_status = Order::PAYMENT_STATUS_APPROVED;
        $this->order->payment_id = $data->orderID;
        $this->order->payment_method = 'PayPal';
        $this->order->payment_data = json_encode($data);
        $this->order->update();
        CheckoutController::processOrder($this->order);
        return Redirect::route('ecommerce.checkout.complete', $this->order);
    }
    public function paymentTransfer(){
        $this->order->payment_status = Order::PAYMENT_STATUS_PENDING;
        $this->order->payment_method = 'Transfer';
        $this->order->update();
        CheckoutController::sendEmailInfoBank($this->order);
        CheckoutController::sendNotificationAdmin($this->order);
        return Redirect::route('ecommerce.checkout.complete', $this->order);
    }
    public function loadStripe(){
        $stripe = new StripeClient(config('services.stripe.secret'));
        $lineItems = [];
        $couponPriceDiscount = intval($this->order->coupon_price_discount);
        $discuountEachProduct = 0;
        if($couponPriceDiscount):
            $discuountEachProduct = $couponPriceDiscount / $this->order->products()->count();
        endif;
        foreach($this->order->products as $product):
            $lineItems[] = [
                'price_data' => [
                    'currency' => strtolower($this->currency),
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => ($product->pivot->price - $discuountEachProduct) * 100
                ],
                'quantity' => $product->pivot->quantity,
            ];
        endforeach;
        $checkoutSessionCreate = [
            'shipping_options' => [
                [
                  'shipping_rate_data' => [
                    'type' => 'fixed_amount',
                    'fixed_amount' => ['amount' => $this->order->shipping_price * 100, 'currency' => strtolower($this->currency)],
                    'display_name' => $this->order->shipping_method,
                  ],
                ],
            ],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'customer_email' => $this->order->shippingAddress ? $this->order->shippingAddress->email : '',
            'metadata' => [
                'external_reference' => $this->order->number,
            ],
            'success_url' => route('ecommerce.checkout.complete', $this->order->number),
            'cancel_url' => route('ecommerce.checkout.payment', $this->order->number)
        ];
        if(!(int) $this->order->shipping_price):
            unset($checkoutSessionCreate['shipping_options']);
        endif;
        $checkout_session = $stripe->checkout->sessions->create($checkoutSessionCreate);
        return $checkout_session->url;
    }
    private function loadMercadoPago(){
        SDK::setAccessToken(config('services.mercadopago.token'));
        $preference = new Preference();
        $shipments = new Shipments();
        $shipments->cost = (double) $this->order->shipping_price;
        $shipments->mode = 'not_specified';
        $products = [];
        $couponPriceDiscount = intval($this->order->coupon_price_discount);
        $discuountEachProduct = 0;
        if($couponPriceDiscount):
            $discuountEachProduct = $couponPriceDiscount / $this->order->products()->count();
        endif;
        foreach($this->order->products as $product):
            $item = new Item();
            $item->id = $product->id;
            $item->title = $product->name;
            $item->currency_id = $this->currency;
            $item->picture_url = $product->imagePreview();
            $item->description = $product->description;
            $item->quantity = $product->pivot->quantity;
            $item->unit_price = (double) ($product->pivot->price - $discuountEachProduct);
            $products[] = $item;
        endforeach;
        $preference->back_urls = [
            'success' => route('ecommerce.checkout.complete', $this->order),
            'pending' => route('ecommerce.checkout.complete', $this->order),
            'failure' => route('ecommerce.checkout.payment', $this->order),
        ];
        $preference->auto_return = "approved";
        $preference->items = $products;
        $preference->shipments = $shipments;
        $preference->statement_descriptor = config('app.name');
        $preference->binary_mode = true; //Los pagos pendientes o aún en proceso serán automáticamente rechazados por defecto
        $preference->external_reference = $this->order->number;
        $preference->save();
        return $preference;
    }
}
