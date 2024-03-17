<div class="">
    <div class="order-summary-wrapper sticky-sidebar">
        <h3 class="">{{ __('Shipping address') }}</h3>
        <address>
            <strong>{{ $order->shippingAddress->state->country->name }}.</strong><br>
            {{ $order->shippingAddress->state->name }}, {{ $order->shippingAddress->municipality }}<br>
            {{ $order->shippingAddress->colony }}, {{ $order->shippingAddress->street }}, Código postal: {{ $order->shippingAddress->zip_code }}<br>
            <abbr title="Phone">{{ __('Phone') }}: {{ $order->shippingAddress->phone }}
            </abbr> <br>
            <abbr title="Email">{{ __('Email') }}: {{ $order->shippingAddress->email }}
            </abbr>
        </address>
    </div>
</div>
@if ($order->billingAddress)
    <div class="">
        <div class="order-summary-wrapper sticky-sidebar">
            <h3 class="">{{ __('Billing address') }}</h3>
            <address>
                <strong>{{ $order->billingAddress->state->country->name }}.</strong><br>
                {{ $order->billingAddress->vat }}, {{ $order->billingAddress->state->name }}, {{ $order->billingAddress->municipality }}<br>
                {{ $order->billingAddress->colony }}, {{ $order->billingAddress->street }}, Código postal: {{ $order->billingAddress->zip_code }}<br>
                <abbr title="Phone">{{ __('Phone') }}: {{ $order->billingAddress->phone }}
                </abbr> <br>
                <abbr title="Email">{{ __('Email') }}: {{ $order->billingAddress->email }}
                </abbr>
            </address>
        </div>
    </div>
@endif
