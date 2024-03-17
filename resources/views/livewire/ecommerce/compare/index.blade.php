<div>
    <!-- Start of PageContent -->
    <div class="page-content mb-5">
        <div class="container">
            <h3 class="compare-title">{{ __('Compare') }}</h3>
            @if (!count($compares))
                <div class="text-center alert alert-primary alert-bg alert-button alert-block">
                    <h4 class="alert-title">{{ __('Empty compare list') }}</h4>
                    {{ __('In this section you will be shown all the products that you have added to your compare list') }}
                    <br>
                    <a href="{{ route('ecommerce.product.index') }}" class="btn btn-primary btn-rounded">{{ __('Show products') }}</a>
                    <button class="btn btn-link btn-close">
                        <i class="close-icon"></i>
                    </button>
                </div>
            @else
                <div class="compare-table">
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-products">
                        <div class="compare-col compare-field">{{ __('Product') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-product">
                                <a
                                    wire:click.prevent="delete('{{ $item->rowId }}')"
                                    wire:target="delete('{{ $item->rowId }}')"
                                    wire:loading.class="load-more-overlay loading"
                                    href="#"
                                    class="btn remove-product">
                                    <i class="w-icon-times-solid"></i>
                                </a>
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                            <img src="{{ $item->model->imagePreview() }}" alt="{{ $item->model->name }}" width="228"
                                                height="257" />
                                        </a>
                                        <div class="product-action-vertical">
                                            @livewire('ecommerce.cart.mini', ['product' => $item->model], key('cart-'.$item->id))
                                            @livewire('ecommerce.wishlist.mini', ['product' => $item->model], key('wishlist-'.$item->id))
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h3 class="product-name">
                                            <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                                {{ $item->model->name }}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Compare Products -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-price">
                        <div class="compare-col compare-field">{{ __('Price') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-value">
                                <div class="product-price">
                                    {!! $item->model->getPriceToString() !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Compare Price -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-availability">
                        <div class="compare-col compare-field">{{ __('Availability') }}</div>
                        @foreach ($compares as $item)
                            @if ($item->model->getIsInStock())
                                <div class="compare-col compare-value">{{ __('In stock') }}</div>
                            @else
                                <div class="compare-col text-dark">{{ __('Out stock') }}</div>
                            @endif
                        @endforeach
                    </div>
                    <!-- End of Compare Availability -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-description">
                        <div class="compare-col compare-field">{{ __('Description') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-value">
                               {!! $item->model->description !!}
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Compare Description -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-reviews">
                        <div class="compare-col compare-field">{{ __('Ratings & Reviews') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-rating">
                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: {{ $item->model->getStarsPercentageAVG() }}%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <a href="{{ route('ecommerce.product.show', $item->model) }}" class="rating-reviews">({{ $item->model->comments()->validate()->count() }} {{ __('Reviews') }})</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Compare Reviews -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-category">
                        <div class="compare-col compare-field">{{ __('Category') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-value">{{ $item->model->productCategories()->first() ? $item->model->productCategories()->first()->name : ''  }}</div>
                        @endforeach
                    </div>
                    <!-- End of Compare Category -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-meta">
                        <div class="compare-col compare-field">{{ __('SKU') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-value">{{ $item->model->sku }}</div>
                        @endforeach
                    </div>
                    <!-- End of Compare Meta -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-color">
                        <div class="compare-col compare-field">{{ __('Color') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-value">
                                @foreach ($item->model->productColors as $color)
                                    <span class="swatch" style="background-color: {{ $color->hexadecimal }};" title="{{ $color->name }}"></span>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Compare Color -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-size">
                        <div class="compare-col compare-field">{{ __('Size') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-value">
                                @foreach ($item->model->productSizes as $size)
                                    {{ $size->name }},
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <!-- End of Compare Size -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-brand">
                        <div class="compare-col compare-field">{{ __('Brand') }}</div>
                        @foreach ($compares as $item)
                            <div class="compare-col compare-value">{{ $item->model->productBrand ? $item->model->productBrand->name : '' }}</div>
                        @endforeach
                    </div>
                    <!-- End of Compare Brand -->
                    <!-- End of Compare Size -->
                    <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-brand">
                        <div class="compare-col compare-field">{{ __('Agregar al carrito') }}</div>
                        @foreach ($compares as $item)
                            <a
                                wire:click.prevent="storeInCart('{{ $item->model->id }}')"
                                wire:target="storeInCart('{{ $item->model->id }}')"
                                wire:loading.class="load-more-overlay loading"
                                wire:loading.disabled
                                class="btn btn-dark btn-rounded d-flex align-items-center justify-content-center"
                                href="#">
                                {{ __('Add to cart') }}
                            </a>
                        @endforeach
                    </div>
                    <!-- End of Compare Brand -->
                </div>
            @endif
        </div>
    </div>
    <!-- End of PageContent -->
</div>
