<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <div class="d-flex flex-column gap-10">
                <!--begin::Search products-->
                <div class="d-flex align-items-center position-relative mb-n7">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="search" class="form-control form-control-solid w-100 w-lg-50 ps-14" placeholder="{{ __('Search...') }}" />
                </div>
                <!--end::Search products-->
                <!--begin::Table-->
                <div class="overflow">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 ">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-25px pe-2">{{ __('Choose') }}</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($products as $product)
                                <!--begin::Table row-->
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom">
                                            <input wire:model.defer="productSimilarIds" id="product-similar-{{ $product->id }}" class="form-check-input" type="checkbox" value="{{ $product->id }}" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::Product=-->
                                    <td>
                                        <label for="product-similar-{{ $product->id }}">
                                            <div class="d-flex align-items-center">
                                                <!--begin::Thumbnail-->
                                                <a target="blank" class="symbol symbol-50px">
                                                    <span class="symbol-label" style="background-image:url({{ $product->imagePreview() }});"></span>
                                                </a>
                                                <!--end::Thumbnail-->
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a target="blank" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $product->name }}</a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </label>
                                    </td>
                                    <!--end::Product=-->
                                </tr>
                                <!--end::Table row-->
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
            </div>
            <!--begin::Input group-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
                <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('Save changes') }}</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
</div>
