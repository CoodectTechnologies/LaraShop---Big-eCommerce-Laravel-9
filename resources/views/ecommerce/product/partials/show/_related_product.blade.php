<section class="related-product-section">
    <div class="title-link-wrapper mb-4">
        <h4 class="title">{{ __('Related products') }}</h4>
        <a href="{{ route('ecommerce.product.index') }}" class="btn btn-dark btn-link btn-slide-right btn-icon-right">{{ __('More products') }}<i class="w-icon-long-arrow-right"></i></a>
    </div>
    <div class="owl-carousel owl-theme row cols-lg-3 cols-md-4 cols-sm-3 cols-2"
        data-owl-options="{
        'nav': false,
        'dots': false,
        'margin': 20,
        'responsive': {
            '0': {
                'items': 2
            },
            '576': {
                'items': 3
            },
            '768': {
                'items': 4
            },
            '992': {
                'items': 3
            }
        }
    }">
        @foreach ($productsRelated as $productRelated)
            @include('ecommerce.product.partials.index._product', ['product' => $productRelated])
        @endforeach
    </div>
</section>
