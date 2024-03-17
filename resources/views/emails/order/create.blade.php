@component('mail::message')

@component('mail::panel')
{{ __('Dear') }}  {{ $order->shippingAddress->name }}
@endcomponent

{{ __('We are excited to inform you that we have successfully received payment for your order in :appname! Here are the details of your purchase:', ['appname' => config('app.name')]) }} <br>

<p>• {{ __('Order number') }}: {{ $order->number }}</p>
<p>• {{ __('Date') }}: {{ $order->created_at }}</p>
<p>• {{ __('Shipping price') }}: {{ $order->shippingPriceToString() }}</p>
<p>• {{ __('Shipping days') }}: {{ $order->shipping_days }}</p>
<p>• {{ __('Shipping method') }}: {{ $order->shipping_method }}</p>
<p>• {{ __('Payment method') }}: {{ $order->payment_method }}</p>
@if($order->coupon)
<p>• {{ __('Coupon') }} -{{ $order->coupon_percentage_discount }}%</p>
@endif
<p>• {{ __('Subtotal') }}: {{ $order->subtotalToString() }}</p>
<p>• {{ __('Total') }}: {{ $order->totalToString() }}</p>

{{ __('Thank you for using :paymentmethod to make your payment. Your transaction has been successfully processed and your order is in the process of being prepared for shipping.', ['paymentmethod' => $order->payment_method]) }} <br>

{{ __('We will notify you again by email once your order has been shipped and provide tracking details so you can track its delivery.') }} <br>

{{ __('If you have any questions about your order or need additional assistance, please do not hesitate to contact our customer service team. We are here to help you every step of the way.') }} <br>

@component('mail::table')
| {{ __('Product') }} |                      | {{ __('Quantity') }} | {{ __('Price') }} |
| ------------------- |:--------------------:| --------------------:| -----------------:|
@foreach ($order->products as $product)
@php
    if($product->pivot->product_color_id):
        $productColor = $product->productColors()->where('id', $product->pivot->product_color_id)->first();
        if(!$productColor):
            $productColor = $product;
        endif;
        $image = $productColor->imagePreview();
    else:
        $image = $product->imagePreview();
    endif;
@endphp
| {{ $product->name }} {{ $product->pivot->color ? ' '.__('Color').': '.$product->pivot->color.'.' : '' }}  {{ $product->pivot->size ? ' '.__('Size').': '.$product->pivot->size : '' }}  | <img src="{{ asset('').$image }}" width="100" alt=""> | {{ $product->pivot->quantity }} | ${{ number_format($product->pivot->price, 2) }} |
@endforeach
@endcomponent

<p>{{ __('Thank you for choosing :appname We hope to serve you soon.', ['appname' => config('app.name')]) }}</p>

@component('mail::button', ['url' => 'https://wa.me/'.config('contact.whatsapp').'?text='.__(' Hi there! I have an order: ').$order->number])
{{ __('Contact us on WhatsApp') }}
@endcomponent

{{ __('Sincerely') }}, {{ config('app.name') }}.
@endcomponent
