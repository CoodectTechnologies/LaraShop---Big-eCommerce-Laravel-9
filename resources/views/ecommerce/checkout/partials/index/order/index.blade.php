<h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
    {{ __('ORDEN') }}
</h3>
<div class="order-summary-wrapper sticky-sidebar">
    {{-- <h3 class="title text-uppercase ls-10">{{ __('Order') }}</h3> --}}
    <div class="order-summary table-responsive">
        <table class="order-table">
            <thead>
                <tr>
                    <th><b>{{ __('Product') }}</b></th>
                    <th></th>
                    <th style="text-align: right;">
                        <b>{{ __('Subtotal ') }}</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::instance('default')->content() as $item)
                    <tr class="bb-no">
                        <td class="pr-2">
                            <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                <img width="80" src="{{ $item->options->image }}" alt="">
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="{{ route('ecommerce.product.show', $item->model) }}">
                            {{ $item->name }}
                            </a>
                            <i class="fas fa-times"></i>
                            <span class="product-quantity">{{ $item->qty }}</span> <br>
                            @if (isset($item->options->color['name']))
                                {{ __('Color') }}: {{ $item->options->color['name'] }} <br>
                            @endif
                            @if (isset($item->options->size['name']))
                                {{ __('Size') }}: {{ $item->options->size['name'] }} <br>
                            @endif
                            @if ($item->options->type)
                                {{ __('Type') }}: {{ $item->options->type }} <br>
                            @endif
                        </td>
                        <td class="product-total">${{ $item->total }} {{ $item->options->currency }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
