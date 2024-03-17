@component('mail::message')

@component('mail::panel')
{{ __('Dear') }}  {{ $user->name }}
@endcomponent

<p>{{ __('Please be informed that a new order has been placed in your :appname store. Here are the details:', ['appname' => config('app.name')]) }}</p>

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

<p>{{ __('Please be sure to process this order in a timely manner and keep the customer updated on the status of the shipment. If you have any questions or need more information, please feel free to contact the customer.') }}</p>

<p>{{ __('Thank you for your dedication in managing our online store') }}.</p>

@component('mail::button', ['url' => route('admin.order.show', $order)])
{{ __('View order') }}
@endcomponent

<p>{{ __('Sincerely') }}, {{ config('app.name') }}</p>

@endcomponent
