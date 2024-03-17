<div class="">
    <div class="order-summary-wrapper sticky-sidebar">
        <h3 class="">{{ __('Summary') }}</h3>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td class="">
                            <strong>{{ __('Subtotal') }}</strong>
                        </td>
                        <td class="text-right">
                            <span class="amount">{{ $order->subtotalToString() }}</span>
                        </td>
                    </tr>
                    @if($order->coupon)
                        <tr>
                            <td class="">
                                <strong>{{ __('Coupon') }}</strong>
                            </td>
                            <td class="text-right">
                                <span class="amount">-{{ $order->coupon_percentage_discount }}%</span>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="">
                            <strong>{{ __('Shipping price') }}</strong>
                        </td>
                        <td class=" text-right">
                            <span class="amount">{{ $order->shippingPriceToString() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <strong>{{ __('Shipping method') }}</strong>
                        </td>
                        <td class=" text-right">
                            <span class="amount">{{ $order->shipping_method ?? 'N/A'}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <strong>{{ __('Total') }}</strong>
                        </td>
                        <td class="text-right">
                            <span class="amount">{{ $order->totalToString() }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
