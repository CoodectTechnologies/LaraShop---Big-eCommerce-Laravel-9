<div class="">
    <div class="order-summary-wrapper sticky-sidebar">
        <h3 class="">{{ __('Order') }}</h3>
        <div class="order-summary table-responsive">
            <table class="order-table">
                <thead>
                    <tr>
                        <th><b>{{ __('Product') }}</b></th>
                        <th style="text-align: right;">
                            <b>{{ __('Total ') }}</b>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                        <tr class="bb-no">
                            <td class="product-name">
                                {{ $product->name }}
                                <i class="fas fa-times"></i>
                                <span class="product-quantity">{{ $product->pivot->quantity }}</span> <br>
                                @if ($product->pivot->color)
                                    {{ __('Color') }}: {{ $product->pivot->color }} <br>
                                @endif
                                @if ($product->pivot->size)
                                    {{ __('Color') }}: {{ $product->pivot->size }} <br>
                                @endif
                                @if ($product->pivot->type)
                                    {{ __('Type') }}: {{ $product->pivot->type }} <br>
                                @endif
                            </td>
                            <td class="product-total">${{ number_format($product->pivot->subtotal, 2) }} {{ $order->currency }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
