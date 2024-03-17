<div>
    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            <h3 class="wishlist-title">{{ __('My wishlist') }}</h3>
            @if (!count($wishlists))
                <div class="text-center alert alert-primary alert-bg alert-button alert-block">
                    <h4 class="alert-title">{{ __('Empty favorites list') }}</h4>
                    {{ __('In this section you will be shown all the products that you have added to your wishlist') }}
                    <br>
                    <a href="{{ route('ecommerce.product.index') }}" class="btn btn-primary btn-rounded">{{ __('Show products') }}</a>
                    <button class="btn btn-link btn-close">
                        <i class="close-icon"></i>
                    </button>
                </div>
            @else
                <table class="shop-table wishlist-table">
                    <thead>
                        <tr>
                            <th class="product-name"><span>{{ __('Product') }}</span></th>
                            <th></th>
                            <th class="product-price"><span>{{ __('Price') }}</span></th>
                            <th class="product-stock-status"><span>{{ __('Stock status') }}</span></th>
                            <th class="wishlist-action">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlists as $wishlist)
                            <tr>
                                <td class="product-thumbnail">
                                    <div class="p-relative">
                                        <a href="{{ route('ecommerce.product.show', $wishlist->model) }}">
                                            <figure>
                                                <img src="{{ $wishlist->model->imagePreview() }}" alt="{{ $wishlist->model->name }}" width="300"
                                                    height="338">
                                            </figure>
                                        </a>
                                        <button wire:click="delete('{{ $wishlist->rowId }}')"
                                                wire:target="delete('{{ $wishlist->rowId }}')"
                                                wire:loading.class="load-more-overlay loading"
                                                class="btn btn-close"
                                                type="submit">
                                                <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="{{ route('ecommerce.product.show', $wishlist->model) }}">
                                        {{ $wishlist->model->name }}
                                    </a>
                                </td>
                                <td class="product-price">
                                    {!! $wishlist->model->getPriceToString() !!}
                                </td>
                                <td class="product-stock-status">
                                    @if ($wishlist->model->getIsInStock())
                                        <span class="wishlist-in-stock">{{ __('In stock') }}</span>
                                    @else:
                                        <span class="wishlist-out-sotck">{{ __('Out stock') }}</span>
                                    @endif
                                </td>
                                <td class="wishlist-action">
                                    <div class="d-lg-flex">
                                        <a href="{{ route('ecommerce.product.show', $wishlist->model) }}" class="btn btn-quickview btn-outline btn-default btn-rounded btn-sm mb-2 mb-lg-0">{{ __('Show') }}</a>
                                        @if ($wishlist->model->getIsInStock())
                                            <a
                                                wire:click.prevent="storeInCart('{{ $wishlist->model->id }}')"
                                                wire:target="storeInCart('{{ $wishlist->model->id }}')"
                                                wire:loading.class="load-more-overlay loading"
                                                wire:loading.disabled
                                                class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart"
                                                href="#">{{ __('Add to cart') }}
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- End of PageContent -->
</div>
