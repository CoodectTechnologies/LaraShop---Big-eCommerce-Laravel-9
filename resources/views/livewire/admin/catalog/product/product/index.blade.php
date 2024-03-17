<div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('Search...') }}" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select wire:model="categoryIdFilter" class="form-select form-select-solid">
                        <option value="">{{ __('All') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                </div>
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select wire:model="stockFilter" class="form-select form-select-solid">
                        <option value="">Stock</option>
                        <option value="">{{ __('All') }}</option>
                        <option value="Bajo">{{ __('Low') }}</option>
                    </select>
                    <!--end::Select2-->
                </div>
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select wire:model="statusFilter" class="form-select form-select-solid">
                        <option value="">{{ __('Status') }}</option>
                        <option value="Publicado">{{ __('Published') }}</option>
                        <option value="Borrador">{{ __('Draft') }}</option>
                    </select>
                    <!--end::Select2-->
                </div>
                <!--end::Item-->
                <div class="dropdown">
                    <a class="btn btn-light-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    {{ __('Actions') }} <span wire:loading wire:target="exportProducts" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a href="{{ route('admin.catalog.product.create') }}" class="dropdown-item">{{ __('New product') }}</a></li>
                        <li><a wire:click="exportProducts" wire:loading.attr="disabled" wire:target="exportProducts" href="#" class="dropdown-item">{{ __('Export products') }}</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_import" class="dropdown-item">{{ __('Import products') }}</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_import_wordpress" class="dropdown-item">{{ __('Import products WoordPress') }}</a></li>
                    </ul>
                </div>
                <!--begin::Button-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        @include('admin.catalog.product.product.import.form')
        @include('admin.catalog.product.product.import.form-wordpress')
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-200px">{{ __('Product') }}</th>
                            <th class="text-end min-w-100px">{{ __('Price') }}</th>
                            <th class="text-end min-w-70px">{{ __('Quantity') }}</th>
                            <th class="text-end min-w-70px">{{ __('Comments') }}</th>
                            <th class="text-end min-w-70px">{{ __('Views') }}</th>
                            <th class="text-end min-w-100px">{{ __('Status') }}</th>
                            <th class="text-end min-w-70px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($products as $product)
                        <!--begin::Table row-->
                        <tr>
                            <!--begin::Category=-->
                            <td>
                                <div class="d-flex align-items-center">
                                    <!--begin:: Avatar -->
                                    <div class="symbol symbol-50px overflow-hidden me-3">
                                        <a href="{{ route('admin.catalog.product.show', $product) }}">
                                            <div class="symbol-label">
                                                <img loading="lazy" src="{{ $product->imagePreview() }}" alt="{{ $product->name }}" class="w-100" />
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('admin.catalog.product.show', $product) }}" class="text-gray-800 text-hover-primary mb-1">{{ $product->name }}</a>
                                        <span>{{ $product->type }}</span>
                                    </div>
                                    <!--begin::User details-->
                                </div>
                                {{-- <div class="d-flex align-items-center">
                                    <!--begin::Thumbnail-->
                                    <a href="{{ route('admin.catalog.product.show', $product) }}" class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url({{ $product->imagePreview() }});"></span>
                                    </a>
                                    <!--end::Thumbnail-->
                                    <div class="ms-5">
                                        <!--begin::Title-->
                                        <a href="{{ route('admin.catalog.product.show', $product) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $product->name }}</a>
                                        <!--end::Title-->
                                        <span>{{ $product->type }}</span>
                                    </div>
                                </div> --}}
                            </td>
                            <!--end::Category=-->
                            <!--begin::Price=-->
                            <td class="text-end pe-0">
                                <span class="fw-bolder text-dark">{!! $product->getPriceToString() !!}</span>
                            </td>
                            <!--end::Price=-->
                            <!--begin::Qty=-->
                            <td class="text-end pe-0">
                                @if ($product->quantity !== null)
                                    <span class="fw-bolder ms-3">{{ $product->quantity }}</span>
                                @else
                                    <span class="fw-bolder ms-3">Ilimitado</span>
                                @endif
                            </td>
                            <!--end::Qty=-->
                            <!--begin::Comment=-->
                            <td class="text-end pe-0">
                                @if (count($product->comments))
                                    <span class="fw-bolder">{{ count($product->comments) }}</span>
                                @else
                                    <span class="fw-bolder badge badge-light-primary">{{ count($product->comments) }}</span>
                                @endif
                            </td>
                            <!--end::Comment=-->
                            <!--begin::Views=-->
                            <td class="text-end pe-0">
                                @if ($product->viewUniques())
                                    <span class="fw-bolder">{{ $product->viewUniques() }}</span>
                                @else
                                    <span class="fw-bolder badge badge-light-primary">{{ $product->viewUniques() }}</span>
                                @endif
                            </td>
                            <!--end::Views=-->
                            <!--begin::Status=-->
                            <td class="text-end pe-0">
                                <!--begin::Badges-->
                                {!! $product->getStatusToString() !!}
                                <!--end::Badges-->
                            </td>
                            <!--end::Status=-->
                            <!--begin::Action=-->
                            <td>
                                <!--begin::Show-->
                                <a href="{{ route('admin.catalog.product.show', $product) }}" class="btn btn-icon btn-active-light-success w-30px h-30px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                    <i class="fa fa-eye"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--begin::Show-->
                                <a href="{{ route('admin.catalog.product.edit', $product) }}" class="btn btn-icon btn-active-light-success w-30px h-30px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                @include('admin.catalog.product.product.delete')
                                <!--end::Action=-->
                            </td>
                        </tr>
                        <!--end::Table row-->
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
            {{ $products->links() }}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    @push('footer')
    <script>
        Livewire.on('render', function(){
            $('.modal').modal('hide');
        });
    </script>
    @endpush
</div>
