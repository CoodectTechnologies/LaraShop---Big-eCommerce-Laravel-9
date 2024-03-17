<div class="store store-list mt-4 border-radius background-hover {{ $this->getCartItem($product->id, $stageType) ? 'background-active' : '' }}">
    <div class="store-header">
        <a href="#" data-toggle="modal" data-target="#information-product-{{ $product->id }}">
            <figure class="store-banner">
                <img class="img-fluid" src="{{ $product->imagePreview() }}" alt="{{ $product->name }}" style="background-color: #40475E" />
            </figure>
        </a>
        @if ($product->featured)
            <label class="featured-label">{{ __('Featured') }}</label>
        @endif
    </div>
    <!-- End of Store Header -->
    <div class="store-content">
        <div class="seller-date">
            <h4 class="store-title ">
                <a href="{{ route('ecommerce.product.show', $product) }}" class="overflow-2-lines">{{ $product->name }}</a>
            </h4>
            <div class="store-address overflow-2-lines">
                {{ $product->detail }}
            </div>
            <div class="d-flex justify-content-end">
                <span class="text-end text-white">{!! isset($pricesSelected[$product->id]) ? '$'.number_format($pricesSelected[$product->id], 2).' '.currency() : $product->getPriceToString() !!}</span>
            </div>
            @if (count($product->productSizes) || count($product->productColors))
                <div class="d-flex justify-content-end">
                    <button
                        class="btn border-radius btn-sm {{ $this->getCartItem($product->id, $stageType) ? 'btn-secondary' : 'btn-primary' }} btn-outline"
                        data-toggle="modal"
                        data-target="#information-product-{{ $product->id }}">
                        @if ($this->getCartItem($product->id, $stageType))
                            {{ __('Edit') }}
                        @else
                            {{ __('Options and more information') }}
                        @endif
                    </button>
                </div>
            @else
                <div class="d-flex justify-content-between">
                    <button class="btn border-radius btn-sm btn-primary btn-outline" data-toggle="modal" data-target="#information-product-{{ $product->id }}">Más informacion</button>
                    <button
                        wire:click="buildCart('{{ $product->slug }}', '{{ $stageType }}')"
                        wire:target.prevent="buildCart('{{ $product->slug }}', '{{ $stageType }}')"
                        wire:loading.class="load-more-overlay loading"
                        wire:loading.disabled
                        class="btn border-radius btn-sm {{ $this->getCartItem($product->id, $stageType) ? 'btn-secondary' : 'btn-primary' }} btn-outline">
                        @if ($this->getCartItem($product->id, $stageType))
                            {{ __('Added') }}
                        @else
                            {{ __('Add') }}
                        @endif
                    </button>
                </div>
            @endif

        </div>
    </div>
    <!-- End of Store Content -->
</div>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="information-product-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <div class="product product-single row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <img class="img-fluid" src="{{ $product->imagePreview() }}" class="d-block w-100" alt="{{ $product->name }}">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="mt-3">{{ $product->name }}</h3>
                        @if (count($product->productSizes) || count($product->productColors))
                            @if ($product->getIsInStock())
                                @if(isset($sizes[$product->id]))
                                    <div class="product-variation-form product-size-swatch">
                                        <label class="lead text-white">
                                            {{ __('Size') }}: {{ isset($sizesSelected[$product->id]) ? $sizesSelected[$product->id]['name'] : ''}}
                                        </label>
                                        <div class="flex-wrap d-flex align-items-center product-variations">
                                            @foreach ($sizes[$product->id] as $size)
                                                <button
                                                    wire:click="selectSize({{ $product->id }}, {{ $size['id'] }})"
                                                    class="size btn border-radius btn-sm btn-primary btn-outline {{ isset($sizesSelected[$product->id]) ? ($sizesSelected[$product->id]['id'] == $size['id'] ? 'active' : '') : '' }}"
                                                    {{ $size['getIsInStock'] > 0 ? '' : 'disabled'}}>
                                                    {{ $size['name'] }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if(isset($colors[$product->id]))
                                    <div class="product-variation-form product-color-swatch">
                                        <label class="lead text-white">
                                            {{ __('Color') }}: {{ isset($colorsSelected[$product->id]) ? $colorsSelected[$product->id]['name'] : '' }}
                                        </label>
                                        <div class="product-variations">
                                            @foreach ($colors[$product->id] as $color)
                                                <button
                                                    wire:click="selectColor({{ $product->id }}, {{ $color['id'] }})"
                                                    class="color {{ isset($colorsSelected[$product->id]) ? ($colorsSelected[$product->id]['id'] == $color['id'] ? 'active' : '') : '' }} "
                                                    style="background-color: {{ $color['hexadecimal'] }}"
                                                    {{ isset($sizesSelected[$product->id]) ? (!$this->validateColorSizeSelected($color['id'], $sizesSelected[$product->id]['id']) ? 'disabled' : '') : '' }}
                                                    {{ $color['getIsInStock'] > 0 ? '' : 'disabled'}}>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="product-variation-form product-price-swatch">
                                    <label class="lead text-white">
                                        {{ __('Price') }}: {!! isset($pricesSelected[$product->id]) ? '$'.number_format($pricesSelected[$product->id], 2).' '.currency() : $product->getPriceToString() !!}
                                    </label>
                                </div>
                            @else
                                <div class="alert alert-warning alert-simple alert-inline">
                                    <h4 class="alert-title">{{ __('Witout stock') }}!</h4> {{ __('Sorry, this product is out of stock') }}
                                </div>
                            @endif
                            <div>
                                <div class="fix-bottom product-sticky-content sticky-content">
                                    <div class="product-form container">
                                        <button
                                            {{ isset($colors[$product->id]) ? (isset($sizesSelected[$product->id]) ? ($sizesSelected[$product->id]['relation_with_colors'] == 'SI' && !isset($colorsSelected[$product->id]) ? 'disabled' : '') : '') : '' }}
                                            {{ isset($colors[$product->id]) ? (!isset($sizesSelected[$product->id]) ? (!isset($colorsSelected[$product->id]) ? 'disabled' : '') : '') : '' }}
                                            {{ isset($sizes[$product->id]) ? (!isset($sizesSelected[$product->id]) ? ' disabled' : '') : '' }}
                                            wire:click="buildCart('{{ $product->slug }}', '{{ $stageType }}')"
                                            wire:target="buildCart('{{ $product->slug }}', '{{ $stageType }}')"
                                            wire:loading.class="load-more-overlay loading"
                                            wire:loading.disabled
                                            class="btn border-radius btn-block btn-primary btn-outline"
                                            type="submit">
                                            <i class="w-icon-cart"></i>
                                            <span>
                                                {{ __('Add') }}
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="compare-table mt-5">
                        <!-- End of Compare Price -->
                        <div class="compare-row compare-availability justify-content-between">
                            <div class="compare-col compare-field text-white lead">{{ __('Availability') }}</div>
                            @if ($product->getIsInStock())
                                <div class="compare-col compare-value lead text-white">{{ __('In stock') }}</div>
                            @else
                                <div class="compare-col text-dark lead">{{ __('Out stock') }}</div>
                            @endif
                        </div>
                        <!-- End of Compare Availability -->
                        <div class="compare-row compare-detail justify-content-between">
                            <div class="compare-col compare-field text-white lead">{{ __('Detail') }}</div>
                            <div class="compare-col compare-value lead text-white">
                                {!! $product->detail !!}
                            </div>
                        </div>
                        <!-- End of Compare Description -->
                        <div class="compare-row compare-reviews justify-content-between">
                            <div class="compare-col compare-field text-white lead">{{ __('Ratings & Reviews') }}</div>
                            <div class="compare-col compare-rating">
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: {{ $product->getStarsPercentageAVG() }}%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="{{ route('ecommerce.product.show', $product) }}" class="rating-reviews">({{ $product->comments()->validate()->count() }} {{ __('Reviews') }})</a>
                                </div>
                            </div>
                        </div>
                        <!-- End of Compare Category -->
                        <div class="compare-row compare-meta justify-content-between">
                            <div class="compare-col compare-field text-white lead">{{ __('SKU') }}</div>
                            <div class="compare-col compare-value lead text-white">{{ $product->sku }}</div>
                        </div>
                        <!-- End of Compare Meta -->
                        <div class="compare-row compare-color justify-content-between">
                            <div class="compare-col compare-field text-white lead">{{ __('Colors') }}</div>
                            <div class="compare-col compare-value lead text-white">
                                @foreach ($product->productColors as $color)
                                    <span class="swatch" style="background-color: {{ $color->hexadecimal }};" title="{{ $color->name }}"></span>
                                @endforeach
                            </div>
                        </div>
                        <!-- End of Compare Color -->
                        <div class="compare-row compare-size justify-content-between">
                            <div class="compare-col compare-field text-white lead">{{ __('Sizes') }}</div>
                            <div class="compare-col compare-value lead text-white">
                                @foreach ($product->productSizes as $size)
                                    {{ $size->name }},
                                @endforeach
                            </div>
                        </div>
                        <!-- End of Compare Size -->
                        <div class="compare-row compare-brand justify-content-between">
                            <div class="compare-col compare-field text-white lead">{{ __('Brand') }}</div>
                            <div class="compare-col compare-value lead text-white">{{ $product->productBrand ? $product->productBrand->name : '' }}</div>
                        </div>
                        <!-- End of Compare Brand -->
                        {!! $product->iframe_url !!}
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
