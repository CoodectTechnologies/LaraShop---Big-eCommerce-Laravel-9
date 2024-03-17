@component('mail::message')

@component('mail::panel')
{{ __('Dear') }} {{ $order->shippingAddress->name }}
@endcomponent

<p>{{ __('We are pleased to inform you that your order with the number :ordernumber has been shipped. Here are the shipping details:', ['ordernumber' => $order->number]) }}</p>

@foreach ($orderTrackings as $orderTracking)
<p>
    • {{ __('Tracking number') }}:
    <a href="{{ $orderTracking->link_tracking }}">
        {{ $orderTracking->number_tracking }}
    </a>
</p>
@endforeach

<p> {{ __('Carrier') }}: {{ $order->shipping_method }}</p>
<p> {{ __('Estimated delivery date') }}: {{ $order->shipping_days }}</p>

<p>{{ __('You can track your package in real time by clicking the link below') }}:</p>
@foreach ($orderTrackings as $orderTracking)
<p>
    <a href="{{ $orderTracking->link_tracking }}">
        {{ $orderTracking->link_tracking }}
    </a>
</p>
@endforeach

<p>{{ __('If you have any questions or need assistance, please do not hesitate to contact our customer service team.') }}</p>

<p>{{ __('Thanks for your purchase!') }}</p>

<p>{{ __('It is not necessary to send email to inform with the status change, as well as confirm the payment status') }}</p>
@endcomponent
