<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row">
        <!--begin::Aside column-->
        <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Details') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-10">
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label required">{{ __('Name') }}</label>
                            <!--end::Label-->
                            <input wire:model.defer="configuratorStage.name.{{ translatable() }}" required type="text" class="form-control mb-2 @error('configuratorStage.name.{{ translatable() }}') invalid-feedback @enderror" placeholder="Ejem: CPU"/>
                            @error('configuratorStage.name.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label required">{{ __('Type') }}</label>
                            <!--end::Label-->
                            <select wire:model.defer="configuratorStage.type" wire:change="loadLastOrder" required class="form-control mb-2 @error('configuratorStage.type') invalid-feedback @enderror" >
                                <option value="">{{ __('Select a option') }}</option>
                                @foreach ($this->getTypes() as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('configuratorStage.type')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label required">{{ __('Order') }}</label>
                            <!--end::Label-->
                            <input wire:model.defer="configuratorStage.order" required type="text" class="form-control mb-2 @error('configuratorStage.order') invalid-feedback @enderror" placeholder="Ejem: 1"/>
                            @error('configuratorStage.order')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="form-label required">{{ __('Optional') }}</label>
                            <!--end::Label-->
                            <select required wire:model.defer="configuratorStage.optional" class="form-select mb-2 @error('configuratorStage.optional') invalid-feedback @enderror">
                                <option value="">{{ __('Select a option') }}</option>
                                <option value="1">{{ __('Optional') }}</option>
                                <option value="0">{{ __('Required') }}</option>
                            </select>
                            @error('configuratorStage.optional')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('General data') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-10">
                        <!--begin::Input group-->
                        <div>
                            <div class="row">
                                <!--begin::Input group-->
                                <div class="col-lg-12">
                                    <div class="fv-row mb-5">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('Filter') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select wire:model="productCategoryFilter" multiple class="form-select mb-2">
                                            <option value="0">{{ __('Select a option') }}</option>
                                            @foreach ($productCategories as $categoryFhater)
                                                <option value="{{ $categoryFhater->id }}" style="font-weight: bold;">{{ $categoryFhater->name }}</option>
                                                @include('admin.catalog.category.partials.form._category', ['categoryFhater' => $categoryFhater])
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Separator-->
                        <div class="separator"></div>
                        <!--end::Separator-->
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
                            <input wire:model="search" type="search" class="form-control form-control-solid w-100 w-lg-100 ps-14" placeholder="{{ __('Search...') }}" />
                        </div>
                        <!--end::Search products-->
                        <!--begin::Table-->
                        <div class="overflow">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 ">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="w-25px pe-2">{{ __('Choose') }}</th>
                                        <th class="w-25px pe-2 text-end">
                                            <button wire:click="selectAllProducts" type="button" class="btn btn-primary">
                                                <span class="indicator-label">{{ __('Select all') }}</span>
                                                <span wire:loading wire:target="selectAllProducts" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </button>
                                        </th>
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
                                                    <input wire:model.defer="productsArray" class="form-check-input" type="checkbox" id="product-{{ $product->id }}" value="{{ $product->id }}" />
                                                </div>
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Product=-->
                                            <td>
                                                <label class="d-flex align-items-center" for="product-{{ $product->id }}">
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
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Order details-->
            <!--end::Meta options-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('admin.configurator.stage.index') }}" class="btn btn-light me-5">{{ __('Cancel') }}</a>
                <!--end::Button-->
                <!--begin::Button-->
                <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                    <span class="indicator-label">{{ __('Save changes') }}</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->
</div>
