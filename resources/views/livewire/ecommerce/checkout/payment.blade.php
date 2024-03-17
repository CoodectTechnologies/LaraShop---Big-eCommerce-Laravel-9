<div class="checkout">
    <div class="container">
        <div class="shop-cart">
            <div class="row">
                <div class="title billing-title text-uppercase ls-10 pt-1 mb-0">
                    <h2>{{ __('Order number') }}: {{ $order->number }}</h2>
                </div>
                <div class="col-lg-6">
                    @include('ecommerce.checkout.partials.payment.address._index')
                    @include('ecommerce.checkout.partials.payment.order._index')
                    @include('ecommerce.checkout.partials.payment.summary._index')
                </div>
                <div class="col-lg-6">
                    @include('ecommerce.checkout.partials.payment.payment._index')
                </div>
            </div>
        </div>
    </div>
    @push('footer')
        <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency={{ $currency }}"></script>
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
            $(document).ready(function(){
                loadPayPayl();
                @if($mercadoPago)
                    loadMercadopago();
                @endif
            });
            function loadPayPayl(){
                const PAYPAL = document.querySelector("#paypal-button");
                if(PAYPAL){
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: '{{ $order->total }}'
                                    }
                                }]
                            });
                        },
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                @this.call('paymentPayPal', data);
                            });
                        }
                    }).render('#paypal-button');
                }
            }
            @if($mercadoPago)
                function loadMercadopago(){
                    const MERCADOPAGO = document.querySelector('#mercadopago-button');
                    if(MERCADOPAGO){
                        const mp = new MercadoPago('{{ config("services.mercadopago.key") }}', {
                            locale: "{{ config('services.mercadopago.country_code') }}",
                        });
                        const bricksBuilder = mp.bricks();
                        mp.bricks().create("wallet", "mercadopago-button", {
                            initialization: {
                                preferenceId: "{{ $mercadoPago->id }}",
                                redirectMode: "modal"
                            },
                            callbacks: {
                                onReady: () => { },
                                onSubmit: () => { },
                                onError: (error) => { console.error(error) },
                            }
                        });
                    }
                }
            @endif
        </script>
    @endpush
</div>
