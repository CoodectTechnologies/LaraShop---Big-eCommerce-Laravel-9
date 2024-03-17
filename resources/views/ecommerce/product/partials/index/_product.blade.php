<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="{{ route('ecommerce.product.show', $product) }}">
                <img src="{{ $product->imagePreview() }}" alt="{{ $product->name }}" width="300"/>
                @if (count($product->images))
                    <img src="{{ $product->images->first()->imagePreview() }}" alt="{{ $product->name }}" width="300">
                @endif
            </a>
            @php $promotion = $product->getPromotion(); @endphp
            @if ($promotion)
                @php
                    $year = \Carbon\Carbon::parse($promotion->date_end)->format('Y');
                    $month = \Carbon\Carbon::parse($promotion->date_end)->format('m');
                    $day = \Carbon\Carbon::parse($promotion->date_end)->format('d');
                @endphp
                <div class="product-countdown-container">
                    <div class="product-countdown countdown-compact" data-until="{{ $year }}, {{ $month }}, {{ $day }}"
                        data-format="DHMS" data-compact="false"
                        data-labels-short="{{ __('Days') }}, {{ __('Hours') }}, {{ __('Mins') }}, {{ __('Secs') }}">
                        00:00:00:00
                    </div>
                </div>
            @endif
            <div class="product-action-horizontal">
                @if ($product->getIsInStock())
                    @livewire('ecommerce.cart.mini', ['product' => $product], key('cart-'.$product->id))
                @endif
                @livewire('ecommerce.wishlist.mini', ['product' => $product], key('wishlist-'.$product->id))
                @livewire('ecommerce.compare.mini', ['product' => $product], key('compare-'.$product->id))
            </div>
            <div class="product-label-group">
                @if ($product->getIsNew())
                    <label class="product-label label-new">{{ __('New') }}</label>
                @endif
                @if (!$product->getIsInStock())
                    <label class="product-label label-hot">{{ __('Without stock') }}</label>
                @endif
                @if ($promotion)
                    <label class="product-label label-discount">{{ $promotion->percentage }}%</label>
                @endif
            </div>
        </figure>
        <div class="product-details">
            <div class="product-cat">
                @foreach ($product->productCategories as $productCategory)
                    <a href="{{ route('ecommerce.product.index', ['category' => $productCategory->slug]) }}">{{ $productCategory->name }}</a>
                @endforeach
            </div>
            <h3 class="product-name">
                <a href="{{ route('ecommerce.product.show', $product) }}">{{ $product->name }}</a>
            </h3>
            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width: {{ $product->getStarsPercentageAVG() }}%;"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="{{ route('ecommerce.product.show', $product) }}#comments" class="rating-reviews">({{ count($product->comments) }} {{ __('Comments') }})</a>
            </div>
            <div class="product-pa-wrapper">
                <div class="product-price">
                    {!! $product->getPriceToString() !!}
                </div>
            </div>
        </div>
    </div>
</div>
