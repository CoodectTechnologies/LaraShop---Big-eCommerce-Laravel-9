<div class="card card-flush py-4">
    <div class="card-body pt-0">
        <div class="d-flex flex-column gap-5">
            <div class="border-0 d-flex justify-content-between align-items-center my-4">
                <h3 class="card-title fw-bolder text-dark">{{ __('Select products') }}</h3>
                @if (Cart::count())
                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent="deleteCart" type="button" class="btn btn-bg-light btn-active-color-warning">
                            {{ __('Clear cart') }}
                            <span wire:loading wire:target="deleteCart()" class="spinner-border spinner-border-sm align-middle"></span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="d-flex align-items-center position-relative mb-n7">
                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input wire:model="search" type="search" class="form-control w-100 ps-14" placeholder="{{ __('Search') }}" />
            </div>
            <div class="overflow">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-200px">{{ __('Product') }}</th>
                            <th class="min-w-100px pe-5">{{ __('Quantity') }}</th>
                            <th class="min-w-100px pe-5">{{ __('Stock') }}</th>
                            <th class="min-w-100px pe-5">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($products as $product)
                            <div class="card card-flush">
                                <tr class="">
                                    <td class="pe-5">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('admin.catalog.product.show', $product) }}" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url({{ $product->imagePreview() }});"></span>
                                            </a>
                                            <div class="ms-5">
                                                <a href="{{ route('admin.catalog.product.show', $product) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $product->name }}</a>
                                                <div class="text-muted fs-7">SKU:
                                                    <span class="ms-5"> {{ $product->sku }}</span>
                                                </div>
                                                <div class="fw-bold fs-7">{{ __('Price') }}:
                                                    <span class="ms-5">
                                                        @if (isset($productPrices[$product->id]))
                                                            {!! $productPrices[$product->id]['priceToString'] !!}
                                                        @else
                                                            {!! $product->getPriceToString() !!}
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="fw-bold fs-7 d-flex align-items-center">{{ __('Type') }}:
                                                    <div class="ms-5 product-form product-variation-form product-type-swatch">
                                                        <div class="flex-wrap d-flex align-items-center product-variations">
                                                            @foreach ($productTypes[$product->id] as $type)
                                                                <button
                                                                    type="button"
                                                                    wire:click.prevent="loadProductType({{ $product->id }}, '{{ $type }}')"
                                                                    class="btn btn-product-variation mb-0 {{ isset($productTypeSelected[$product->id]) ? ($productTypeSelected[$product->id] == $type ? 'btn-primary' : 'btn-outline btn-outline-dashed btn-outline-default') : 'btn btn-outline btn-outline-dashed btn-outline-default' }}">
                                                                    {{ $type }}
                                                                </button>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (isset($productSizes[$product->id]))
                                                    <div class="fw-bold fs-7 d-flex align-items-center">{{ __('Sizes') }}:
                                                        <div class="ms-5 product-form product-variation-form product-size-swatch">
                                                            <div class="flex-wrap d-flex align-items-center product-variations">
                                                                @foreach ($productSizes[$product->id] as $size)
                                                                    <button
                                                                        type="button"
                                                                        wire:click.prevent="loadProductSize({{ $product->id }}, {{ $size->id }})"
                                                                        class="btn btn-product-variation mb-0 {{ isset($productSizeSelected[$product->id]) ? ($productSizeSelected[$product->id]['id'] == $size->id ? 'btn-primary' : 'btn-outline btn-outline-dashed btn-outline-default') : 'btn btn-outline btn-outline-dashed btn-outline-default' }}"
                                                                        {{ $size->getIsInStock() > 0 ? '' : 'disabled'}}>
                                                                        {{ $size->name }}
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (isset($productColors[$product->id]))
                                                    <div class="fw-bold fs-7 d-flex align-items-center">{{ __('Colors') }}:
                                                        <div class="ms-5 product-form product-variation-form product-color-swatch">
                                                            <div class="flex-wrap d-flex align-items-center product-variations">
                                                                @foreach ($productColors[$product->id] as $color)
                                                                    <button
                                                                        type="button"
                                                                        wire:click.prevent="loadProductColor({{ $product->id }}, {{ $color->id }})"
                                                                        style="background-color: {{ $color->hexadecimal }}"
                                                                        class="btn btn-product-variation mb-0 color {{ isset($productColorSelected[$product->id]) ? ($productColorSelected[$product->id]['id'] == $color->id ? 'active' : '') : '' }}"
                                                                        {{ isset($productSizeSelected[$product->id]) ? (!$color->validateColorSizeSelected($productSizeSelected[$product->id]['id']) ? 'disabled' : '') : '' }}
                                                                        {{ $color->getIsInStock() > 0 ? '' : 'disabled'}}>
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pe-5">
                                        <input wire:model="productQuantitySelected.{{ $product->id }}" type="number" class="form-control" placeholder="Qty" name="quantity[]"/>
                                    </td>
                                    <td class="pe-5">
                                        <span class="fw-bolder ms-3">
                                            @if (isset($productQuantities[$product->id]))
                                                {{ $productQuantities[$product->id ?? __('Unlimited')] }}
                                            @else
                                                {{ $product->quantity ?? __('Unlimited') }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button
                                            {{ (isset($productTypes[$product->id]) && !isset($productTypeSelected[$product->id])) ? 'disabled' : '' }}
                                            {{ (isset($productColors[$product->id]) && isset($productTypeSelected[$product->id]) && $productTypeSelected[$product->id] == 'Físico') ? (isset($productSizeSelected[$product->id]) ? ($productSizeSelected[$product->id]['relation_with_colors'] == 'SI' && !isset($productColorSelected[$product->id]) ? 'disabled' : '') : '') : '' }}
                                            {{ (isset($productColors[$product->id]) && isset($productTypeSelected[$product->id]) && $productTypeSelected[$product->id] == 'Físico') ? (!isset($productSizeSelected[$product->id]) ? (!isset($productColorSelected[$product->id]) ? 'disabled' : '') : '') : '' }}
                                            {{ (isset($productSizes[$product->id]) && isset($productTypeSelected[$product->id]) && $productTypeSelected[$product->id] == 'Físico') ? (!isset($productSizeSelected[$product->id]) ? ' disabled' : '') : '' }}
                                            wire:click.prevent="addProduct({{ $product->id }})"
                                            class="btn btn-light-primary"
                                            type="button">
                                            <span wire:loading.remove wire:target="addProduct({{ $product->id }})">{{ __('Add') }}</span>
                                            <span wire:loading wire:target="addProduct({{ $product->id }})" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </button>
                                    </td>
                                </tr>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
            <div class="separator"></div>
            <div>
                <div class="mb-xl-8 mt-xl-8">
                    <div class="border-0">
                        <h3 class="card-title fw-bolder text-dark">{{ __('Products selected') }}</h3>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-xl-2 row-cols-md-2 border border-dashed rounded pt-3 pb-1 mb-5 mh-300px overflow-scroll">
                    @foreach (Cart::content() as $item)
                        <div class="col my-2">
                            <div class="d-flex align-items-center border border-dashed rounded p-3 bg-white">
                                <a href="{{ route('admin.catalog.product.show', $item->model) }}" class="symbol symbol-50px">
                                    <span class="symbol-label" style="background-image:url({{ $item->options->image }});"></span>
                                </a>
                                <div class="ms-5">
                                    <a href="{{ route('admin.catalog.product.show', $item->model) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $item->name }}</a>
                                    <div class="fw-bold fs-7">
                                        <span>Qty: {{ $item->qty }} | {{ __('Price') }}: ${{ $item->subtotal() }} {{ session()->get('currency') }}</span>
                                    </div>
                                    <div class="text-muted fs-7">SKU: {{ $item->model->sku }}</div>
                                    @if(isset($item->options->size['name']))
                                        <div class="text-muted fs-7">{{ __('Size') }}: {{ $item->options->size['name'] }}</div>
                                    @endif
                                    @if(isset($item->options->color['name']))
                                        <div class="text-muted fs-7">{{ __('Color') }}: {{ $item->options->color['name'] }}</div>
                                    @endif
                                    @if($item->options->type)
                                        <div class="text-muted fs-7">{{ __('Type') }}: {{ $item->options->type }}</div>
                                    @endif
                                </div>
                                <span wire:click.prevent="deleteCart('{{ $item->rowId }}')" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                                    <i wire:loading.remove class="bi bi-x fs-2"></i>
                                    <span wire:loading wire:target="deleteCart('{{ $item->rowId }}')" class="spinner-border spinner-border-sm align-middle"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="fw-bolder fs-4 text-end">{{ __('Subtotal') }}: $
                <span>{{ Cart::subtotal() }} {{ session()->get('currency') }}</span></div>
            </div>
        </div>
    </div>
</div>
