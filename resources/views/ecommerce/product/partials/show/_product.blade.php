<div wire:ignore.self class="product-details" data-sticky-options="{'minWidth': 767}">
    <h2 class="product-title">{{ $product->name }}</h2>
    <div class="product-bm-wrapper">
        @if ($product->productBrand)
            <figure class="brand">
                <img src="{{ $product->productBrand->imagePreview() }}" alt="{{ $product->productBrand->name }}" width="102"/>
            </figure>
        @endif
        <div class="product-meta">
            <div class="product-categories category">
                {{ __('Category') }}:
                @foreach ($product->productCategories as $productCategory)
                    <span class="product-category category"><a href="{{ route('ecommerce.product.index', ['category' => $productCategory->slug]) }}">{{ $productCategory->name }}</a></span>
                @endforeach
            </div>
            @if (count($product->productGenders))
                <div class="product-categories gender">
                    {{ __('Genders') }}:
                    @foreach ($product->productGenders as $productGender)
                        <span class="product-category gender"><a href="{{ route('ecommerce.product.index', ['gender' => $productGender->slug]) }}">{{ $productGender->name }}</a></span>
                    @endforeach
                </div>
            @endif
            <div class="product-categories type">
                {{ __('Type of product') }}:
                <span class="product-category type"><a href="{{ route('ecommerce.product.index', ['type' => $product->type]) }}">{{ $product->type }}</a></span>
            </div>
            <div class="product-categories sku">
                SKU: <span class="product-category sku">{{ $product->sku ?? 'N/A' }}</span>
            </div>
            <div class="product-categories qty">
                {{ __('Quantity') }}:
                <span class="product-category qty">
                    @if ($quantity !== null)
                        {{ $quantity }}
                    @else
                        Ilimitado
                    @endif
                </span>
            </div>
        </div>
    </div>
    <hr class="product-divider">
    <div class="product-price">{!! $priceToString !!}</div>
    <div class="ratings-container">
        <div class="ratings-full">
            <span class="ratings" style="width: {{ $product->getStarsPercentageAVG() }}%;"></span>
            <span class="tooltiptext tooltip-top"></span>
        </div>
        <a href="#product-tab-reviews" class="rating-reviews scroll-to">({{ $commentCount }}) {{ __('Comments') }}</a>
    </div>
    <div class="product-short-desc" style="white-space: pre-line;">
        {!! $product->detail !!}
    </div>
    @if ($product->technical_datasheet)
        <a href="{{ Storage::url($product->technical_datasheet) }}" download="download" class="btn btn-link btn-primary btn-simple">{{ __('Download technical datasheet') }}</a>
    @endif
    @if ($product->getIsInStock())
        @if ($product->getIsDigital())
            <div class=""></div>
            <hr class="product-divider">
            <div class="product-form product-variation-form product-type-swatch">
                <label class="mb-1">{{ __('Type') }}: </label>
                <div class="flex-wrap d-flex align-items-center product-variations w-100">
                    <select wire:model="type" class="form-control type input-sm">
                        @foreach ($this->getTypes() as $t)
                            <option value="{{ $t }}">{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class=""></div>
        <hr class="product-divider">
        <div class="{{ $type == 'Físico' ?  'd-block' : 'd-none' }}">
            @if(count($sizes))
                <div class="product-form product-variation-form product-size-swatch">
                    <label class="mb-1">{{ __('Size') }}:</label>
                    <div class="flex-wrap d-flex align-items-center product-variations">
                        @foreach ($sizes as $size)
                            <button
                                wire:click="loadSize({{ $size->id }})"
                                class="size {{ $sizeSelected ? ($sizeSelected->id == $size->id ? 'active' : '') : '' }}"
                                {{ $size->getIsInStock() > 0 ? '' : 'disabled'}}>
                                {{ $size->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
            @if(count($colors))
                <div class="product-form product-variation-form product-color-swatch">
                    <label>{{ __('Color') }}: </label>
                    <div class="d-flex align-items-center product-variations">
                        @foreach ($colors as $color)
                            <button
                                wire:click="loadColor({{ $color->id }})"
                                class="color {{ $colorSelected ? ($colorSelected->id == $color->id ? 'active' : '') : '' }} "
                                style="background-color: {{ $color->hexadecimal }}"
                                {{ $sizeSelected ? (!$color->validateColorSizeSelected($sizeSelected->id) ? 'disabled' : '') : '' }}
                                {{ $color->getIsInStock() > 0 ? '' : 'disabled'}}>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
            @if($colorSelected || $sizeSelected)
                <a wire:click="resetVariation" href="#" class="btn btn-link btn-primary btn-simple">{{ __('Clean All') }}</a>
            @endif
        </div>
        <form wire:submit.prevent="addCart">
            <div class="fix-bottom product-sticky-content sticky-content">
                <div class="product-form container">
                    <div class="product-qty-form">
                        <div class="input-group">
                            <input
                                wire:model.defer="quantitySelected"
                                min="1"
                                required
                                class="quantity form-control"
                                type="number"
                                x-bind:disabled="'{{ $type }}' == 'Digital'"
                                x-bind:max="'{{ $type }}' == 'Digital' ? 1 : {{ ($quantity ?? 999999) }}"
                            />
                        </div>
                    </div>
                    <button
                        {{ count($colors) && $type == 'Físico' ? ($sizeSelected ? ($sizeSelected->relation_with_colors == 'SI' && !$colorSelected ? 'disabled' : '') : '') : '' }}
                        {{ count($colors) && $type == 'Físico' ? (!$sizeSelected ? (!$colorSelected ? 'disabled' : '') : '') : '' }}
                        {{ count($sizes) && $type == 'Físico' ? (!$sizeSelected ? ' disabled' : '') : '' }}
                        wire:target="addCart"
                        wire:loading.class="load-more-overlay loading"
                        wire:loading.disabled
                        class="btn btn-primary btn-cart"
                        type="submit">
                        <i class="w-icon-cart"></i>
                        <span>{{ __('Add') }}</span>
                    </button>
                </div>
            </div>
        </form>
    @else
        <div class="alert alert-warning alert-simple alert-inline">
            <h4 class="alert-title">{{ __('Witout stock') }}!</h4> {{ __('Sorry, this product is out of stock') }}
        </div>
    @endif
    <div class="social-links-wrapper">
        <div class="social-links">
            <div class="social-icons social-no-color border-thin">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('ecommerce.product.show', $product) }}" class="social-icon social-facebook w-icon-facebook"></a>
                <a href="https://wa.me?text={{ $product->slug }}" data-action="share/whatsapp/share" class="social-icon social-whatsapp fab fa-whatsapp" target="_blank"> </a>
            </div>
        </div>
        <span class="divider d-xs-show"></span>
        <div class="product-link-wrapper d-flex">
            @livewire('ecommerce.wishlist.mini', ['product' => $product], key('wishlist-'.$product->id))
            @livewire('ecommerce.compare.mini', ['product' => $product], key('compare-'.$product->id))
        </div>
    </div>
    <div class="row mt-5 col-lg-7">
        @if ($product->link_amazon)
            <div class="col-6">
                <a href="{{ $product->link_amazon }}" target="_blank" rel="noopener noreferrer">
                    <img class="img-fluid" src="{{ asset('assets/ecommerce/images/marketplace/amazon.png') }}" alt="Amazon">
                </a>
            </div>
        @endif
        @if ($product->link_mercadolibre)
            <div class="col-6">
                <a href="{{ $product->link_mercadolibre }}" target="_blank" rel="noopener noreferrer">
                    <img class="img-fluid" src="{{ asset('assets/ecommerce/images/marketplace/mercadolibre.png') }}" alt="Mercado libre">
                </a>
            </div>
        @endif
    </div>
</div>
