<div class="order-summary-wrapper sticky-sidebar background-2 border-radius">
    {{-- <h3 class="title text-uppercase ls-10">{{ __('Order') }}</h3> --}}
    <div class="order-summary p-3">
        <table class="order-table">
            @foreach(Cart::instance('configurator')->content() as $cart):
                <thead>
                    <tr>
                        <th style="text-align: start;"><b>{{ $cart->options->stage['name'] }}</b></th>
                        <th style="text-align: end;"><b>{{ __('Subtotal ') }}</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bb-no ">
                        <td class="pr-2" style="max-width: 40vh;">
                            <a href="{{ route('ecommerce.product.show', $cart->model) }}" class="text-white"> {{ $cart->name }} </a>
                        </td>
                        <td class="product-totals text-white text-uppercase">${{ $cart->subtotal() }} {{ currency() }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>
