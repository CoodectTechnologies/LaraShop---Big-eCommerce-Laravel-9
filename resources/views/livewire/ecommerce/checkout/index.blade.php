<div>
    <div class="checkout">
        <div class="page-content">
            <div class="container">
                @include('ecommerce.checkout.partials.index.login._index')
                <form wire:submit.prevent="createOrder" novalidate class="" id="form">
                    <div class="row">
                        <div class="tab-content col-lg-6 pr-lg-4 mb-4 border-right">
                            <div class="mb-5">
                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                    {{ __('Shipping address') }}
                                </h3>
                                @include('ecommerce.checkout.partials.index.shipping-address._index')
                                @include('ecommerce.checkout.partials.index.shipping-address._create')
                                @include('ecommerce.checkout.partials.index.shipping-address._create-diferent')
                            </div>
                            <div class="mb-5">
                                <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-0 mb-0">
                                    {{ __('Billing address') }}
                                </h3>
                                @include('ecommerce.checkout.partials.index.billing-address._index')
                                @include('ecommerce.checkout.partials.index.billing-address._create')
                                @include('ecommerce.checkout.partials.index.billing-address._create-diferent')
                            </div>
                        </div>
                        <div class="col-lg-6 pl-lg-4 mb-4 sticky-sidebar-wrapper">
                            @include('ecommerce.checkout.partials.index.order.index')
                            @include('ecommerce.checkout.partials.index.shipping-method._index')
                            @include('ecommerce.checkout.partials.index.summary.index')
                            @include('ecommerce.checkout.partials.index.coupon._index')
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @push('footer')
            <script>
                Livewire.on('errorAddresses', function(){
                    $('html, body').animate({
                        'scrollTop': $('#form').offset().top
                    }, 1000);
                });
            </script>
        @endpush
    </div>
</div>
