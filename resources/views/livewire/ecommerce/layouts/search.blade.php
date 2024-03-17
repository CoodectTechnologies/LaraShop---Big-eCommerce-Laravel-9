<div class="w-100">
    <form method="get" action="{{ route('ecommerce.product.index') }}" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">
        <input wire:model="search" type="text" value="{{ request()->search }}" autocomplete="off" class="form-control" name="search" id="search"
            placeholder="{{ __('Search') }} ..." required />
        <button class="btn btn-search" type="submit"><i class="w-icon-search"></i></button>
        @if (strlen($search) >= 3)
            {{-- SEARCH DROPDOWN --}}
            <div class="search__dropdown suggestions search__dropdown--open">
                <div class="">
                    <div class="">{{ __('Products') }}</div>
                    @forelse ($products as $product)
                        <div onclick="location='{{ route('ecommerce.product.show', $product) }}'" class="row d-flex align-items-center menu-result-search">
                            <div class="col-lg-3">
                                <img width="50" src="{{ $product->imagePreview() }}" alt="{{ $product->name }}">
                            </div>
                            <div class="col-lg-9">
                                <a href="{{ route('ecommerce.product.show', $product) }}">{{ $product->name }} {!! $product->getPriceToString() !!}</a>
                            </div>
                        </div>
                    @empty
                        <div class="">
                            <p class="">No se encontraron productos</p>
                        </div>
                    @endforelse
                    @if (count($products) >= 5)
                        <div class="">
                            <p class=""><a href="{{ route('ecommerce.product.index', ['search' => $this->search]) }}">Ver más productos</a></p>
                        </div>
                    @endif
                </div>
                <div class="">
                    <div class="mt-3">{{ __('Categories') }}</div>
                    @forelse ($categories as $category)
                        <div onclick="location='{{ route('ecommerce.product.index', ['category' => $category->slug]) }}'" class="row d-flex align-items-center menu-result-search">
                            <div class="col-lg-3">
                                <img width="50" src="{{ $category->imagePreview() }}" alt="{{ $category->name }}">
                            </div>
                            <div class="col-lg-9">
                                <a href="{{ route('ecommerce.product.index', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                    <span class="text-end">({{ count($category->allProductsByCategory()) }})</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="">
                            <p class="">No se encontraron categorías</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endif
    </form>
</div>
