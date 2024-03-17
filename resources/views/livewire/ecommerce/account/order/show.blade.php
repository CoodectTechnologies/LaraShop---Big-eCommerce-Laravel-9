<!-- Start of PageContent -->
<div class="page-content pt-2">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">

            @include('ecommerce.account.menu.index')

            <div class="tab-content mb-6">
                <div class="tab-pane active in" id="account-order">
                    <div class="order">
                        <!-- Start of PageContent -->
                        <div class="page-content mb-10 pb-2">
                            <div class="container">
                                <ul class="order-view list-style-none">
                                    <li>
                                        <label>{{ __('Order number') }}</label>
                                        <strong>{{ $order->number }}</strong>
                                    </li>
                                    <li>
                                        <label>{{ __('Status') }}</label>
                                        <strong>{!! $order->statusToString() !!}</strong>
                                    </li>
                                    <li>
                                        <label>{{ __('Date') }}</label>
                                        <strong>{{ $order->dateToString() }}</strong>
                                    </li>
                                    <li>
                                        <label>{{ __('Total') }}</label>
                                        <strong>{{ $order->totalToString() }}</strong>
                                    </li>
                                    <li>
                                        <label>{{ __('Payment method') }}</label>
                                        <strong>{{ $order->payment_method ?? 'Sin método' }}</strong>
                                    </li>
                                    <li>
                                        <label>{{ __('Payment status') }}</label>
                                        <strong>{!! $order->paymentStatusToString() !!}</strong>
                                    </li>
                                </ul>
                                <!-- End of Order View -->

                                @if (
                                    !in_array($order->status, ['Devolución', 'Cancelado']) &&
                                    !in_array($order->payment_status, ['Aprobado'])
                                )
                                    <div class="text-center mb-5">
                                        <a href="{{ route('ecommerce.checkout.payment', $order) }}" class="btn btn-primary">Reintentar pago</a>
                                    </div>
                                @endif

                                <div class="order-details-wrapper mb-5">
                                    <h4 class="title text-uppercase ls-25 mb-5">{{ __('Order details') }}</h4>
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th class="text-dark">{{ __('Product') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->products as $product)
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            {{ $product->name }}</a>&nbsp;<strong>x {{ $product->pivot->quantity }}</strong><br>
                                                            @if ($product->pivot->color)
                                                                {{ __('Color') }}: {{ $product->pivot->color }} <br>
                                                            @endif
                                                            @if ($product->pivot->size)
                                                                {{ __('Size') }}: {{ $product->pivot->size }} <br>
                                                            @endif
                                                            @if ($product->pivot->type)
                                                                {{ __('Type') }}: {{ $product->pivot->type }}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        ${{ number_format($product->pivot->subtotal, 2) }} {{ $order->currency }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>{{ __('Subtotal') }}:</th>
                                                <td>{{ $order->subtotalToString() }}</td>
                                            </tr>
                                            @if ($order->coupon)
                                                <tr>
                                                    <th>{{ __('Coupon') }}:</th>
                                                    <td>-{{ $order->coupon_percentage_discount }}%</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>{{ __('Shipping price') }}:</th>
                                                <td>{{ $order->shippingPriceToString() }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Payment method') }}:</th>
                                                <td>{{ $order->payment_method }}</td>
                                            </tr>
                                            <tr class="total">
                                                <th class="border-no">{{ __('Total') }}:</th>
                                                <td class="border-no">{{ $order->totalToString() }}</td>
                                            </tr>
                                            @foreach ($order->orderTrackings as $orderTracking)
                                                <tr class="total">
                                                    <th class="border-no">
                                                        {{ __('Guide') }}: {{ $orderTracking->number_tracking }} <br>
                                                        @if ($orderTracking->link_tracking)
                                                            {{-- <td class="border-no"> --}}
                                                                <a href="{{ $orderTracking->link_tracking }}" target="_blank" rel="noopener noreferrer">
                                                                    {{ $orderTracking->link_tracking }}
                                                                </a>
                                                            {{-- </td> --}}
                                                        @endif
                                                    </th>

                                                </tr>
                                            @endforeach
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- End of Order Details -->
                                <div id="account-addresses">
                                    <div class="row">
                                        @if ($order->shippingAddress)
                                            <div class="col-sm-6 mb-8">
                                                <div class="ecommerce-address shipping-address">
                                                    <h4 class="title title-underline ls-25 font-weight-bold">{{ __('Shipping address') }}</h4>
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
                                        @endif
                                        @if ($order->billingAddress)
                                            <div class="col-sm-6 mb-8">
                                                <div class="ecommerce-address billing-address">
                                                    <h4 class="title title-underline ls-25 font-weight-bold">{{ __('Billing Address') }}</h4>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of PageContent -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of PageContent -->
