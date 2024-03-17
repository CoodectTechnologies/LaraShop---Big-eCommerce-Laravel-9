<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2" wire:ignore.self>
    <div class="cart-overlay"></div>
    <a href="{{ route('ecommerce.cart.index') }}" class="cart-toggle label-down link">
        <i class="w-icon-cart">
            <span class="cart-count">{{ Cart::instance('default')->count() }}</span>
        </i>
        <span class="cart-label">{{ __('Cart') }}</span>
    </a>
    <div class="dropdown-box">
        <div class="products">
            @forelse (Cart::instance('default')->content() as $item)
                <div class="product product-cart" style="border-top: 1px solid #eee;">
                    <div class="product-detail">
                        <a href="{{ route('ecommerce.product.show', $item->model) }}" class="product-name">
                            {{ $item->name }}
                        </a>
                        @if (isset($item->options->color['name']))
                            <span style="font-size: 1.2rem">{{ __('Color') }}: {{ $item->options->color['name'] }}</span style="font-size: 1.2rem"> <br>
                        @endif
                        @if (isset($item->options->size['name']))
                            <span style="font-size: 1.2rem">{{ __('Size') }}: {{ $item->options->size['name'] }}</span style="font-size: 1.2rem"> <br>
                        @endif
                        @if ($item->options->type)
                            <span style="font-size: 1.2rem">{{ __('Type') }}: {{ $item->options->type }}</span style="font-size: 1.2rem">
                        @endif
                        <div class="price-box">
                            <span class="product-quantity">{{ $item->qty }}</span>
                            <span class="product-price">{{ $item->subtotal() }} {{ $item->options->currency }}</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="{{ route('ecommerce.product.show', $item->model) }}">
                            <img src="{{ $item->options->image }}" alt="{{ $item->name }}" height="84" width="94" />
                        </a>
                    </figure>
                    <button
                        wire:loading.class="load-more-overlay loading"
                        wire:click.prevent="removeProduct('{{ $item->rowId }}', {{ $item->model->id }})" class="btn btn-link btn-close"
                        wire:target="removeProduct('{{ $item->rowId }}', {{ $item->model->id }})"
                        >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @empty
                <div class="alert alert-success alert-button">
                    <a href="{{ route('ecommerce.product.index') }}" class="btn btn-success btn-rounded">
                        {{ __('Empty cart') }}
                    </a>
                </div>
            @endforelse
        </div>
        <div class="cart-total">
            <label>{{ __('Subtotal') }}:</label>
            <span class="price">{{ Cart::instance('default')->subtotal() }} {{ session()->get('currency') }} </span>
        </div>
        @if (Cart::instance('default')->count())
            <div class="cart-action">
                @if (Route::has('ecommerce.cart.index'))
                    <a href="{{ route('ecommerce.cart.index') }}" class="btn btn-dark btn-outline btn-rounded">{{ __('Show cart') }}</a>
                @endif
                @if (Route::has('ecommerce.checkout.index'))
                    <a href="{{ route('ecommerce.checkout.index') }}" class="btn btn-primary  btn-rounded">{{ __('Checkout') }}</a>
                @endif
            </div>
        @endif
    </div>
    <!-- End of Dropdown Box -->
</div>
