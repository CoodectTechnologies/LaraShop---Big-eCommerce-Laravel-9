<!-- Start of PageContent -->
<div class="page-content pt-2">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">

            @include('ecommerce.account.menu.index')

            <div class="tab-content mb-6">
                <div class="tab-pane active in" id="account-product-digital">
                    <div class="icon-box icon-box-side icon-box-light">
                        <span class="icon-box-icon icon-download">
                            <i class="w-icon-download"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-capitalize ls-normal mb-0">{{ __('My products digitals') }}</h4>
                        </div>
                    </div>
                    <div class="row product-wrapper mb-7 mt-5">
                        @foreach ($productsDigitals as $product)
                            <div class="col-md-3 col-6">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{ route('ecommerce.account.product-digital.show', $product) }}">
                                            <img src="{{ $product->imagePreview() }}" alt="Product" width="295" />
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h3 class="product-name">
                                            <a href="{{ route('ecommerce.account.product-digital.show', $product) }}">{{ $product->name }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
