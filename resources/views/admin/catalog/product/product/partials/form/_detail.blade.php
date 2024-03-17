<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __('Details') }}</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Categoríes-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label">{{ __('Categories') }}</label>
        <!--end::Label-->
        <!--begin::Select-->
        <select wire:model.defer="catalogCategoryArray" multiple="multiple" class="form-select mb-2 @error('catalogCategoryArray') invalid-feedback @enderror" style="height: 200px;">
            <option value="">{{ __('Without categories') }}</option>
            @foreach ($categories as $categoryFhater)
                <option value="{{ $categoryFhater->id }}" style="font-weight: bold;">{{ $categoryFhater->name }}</option>
                @include('admin.catalog.category.partials.form._category', ['categoryFhater' => $categoryFhater, 'style' => 'padding-left: 15px;'])
            @endforeach
        </select>
        <!--end::Select-->
        @error('catalogCategoryArray')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        <!--end::Input group-->
        <!--begin::Button-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_add_catalog_category" class="btn btn-light-primary btn-sm mb-10">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->{{ __('New category') }}
        </a>
        <!--end::Button-->
    </div>
    <!--end::Categoríes-->
    <!--begin::Genders-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label">{{ __('Gender') }}</label>
        <!--end::Label-->
        <!--begin::Select2-->
        <select wire:model.defer="catalogGenderArray" multiple="multiple" class="form-select mb-2 @error('product.catalogGenderArray') invalid-feedback @enderror" style="height: 200px;">
            <option value="">{{ __('Without gender') }}</option>
            @foreach ($genders as $gender)
                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
            @endforeach
        </select>
        <!--end::Select2-->
        @error('catalogGenderArray')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        <!--end::Input group-->
        <!--begin::Button-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_add_catalog_gender" class="btn btn-light-primary btn-sm mb-10">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->{{ __('New gender') }}
        </a>
        <!--end::Button-->
    </div>
    <!--end::Genders-->
    <!--begin::Brands-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label">{{ __('Brand') }}</label>
        <!--end::Label-->
        <!--begin::Select2-->
        <select wire:model.defer="product.product_brand_id" class="form-select mb-2 @error('product.product.product_brand_id') invalid-feedback @enderror" data-control="select2" data-placeholder="{{ __('Select a option') }}" data-allow-clear="true">
            <option value="">{{ __('Select a option') }}</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        <!--end::Select2-->
        @error('product.product_brand_id')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        <!--end::Input group-->
        <!--begin::Button-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_add_catalog_brand" class="btn btn-light-primary btn-sm mb-10">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->{{ __('New brand') }}
        </a>
        <!--end::Button-->
    </div>
    <!--end::Brands-->
    <div class="card card-flush py-4">
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Label-->
            <label class="form-label">{{ __('Status') }}</label>
            <!--end::Label-->
            <!--begin::Select2-->
            <select required wire:model.defer="product.status" class="form-select mb-2">
                <option value="">{{ __('Select a option') }}</option>
                <option value="Publicado">{{ __('Published') }}</option>
                <option value="Borrador">{{ __('Draft') }}</option>
            </select>
            <!--end::Select2-->
            @error('product.status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Card body-->
    </div>
    <div class="card card-flush py-4">
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Label-->
            <label class="form-label">{{ __('Type') }}</label>
            <!--end::Label-->
            <!--begin::Select2-->
            <select required wire:model="product.type" class="form-select mb-2">
                <option value="">{{ __('Select a option') }}</option>
                <option value="Físico">{{ __('Physical') }}</option>
                <option value="Digital">{{ __('Digital') }}</option>
                <option value="Físico y Digital">{{ __('Physical and digital') }}</option>
            </select>
            <!--end::Select2-->
            @error('product.type')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Card body-->
    </div>

    <div class="card card-flush py-4 {{ $product->getIsDigital() ? 'd-block' : 'd-none' }}">
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Label-->
            <label class="form-label required">{{ __('File digital') }}</label>
            <!--end::Label-->
            <div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <!--begin::Label-->
                <!--begin::Image input wrapper-->
                <div class="mt-1">
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline">
                        @if ($fileDigitalTmp)
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" width="100%" height="400px" allowfullscreen src="{{ $fileDigitalTmp->temporaryUrl() }}"></iframe>
                            </div>
                        @elseif ($product->file_digital && Storage::exists($product->file_digital))
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" width="100%" height="400px" allowfullscreen src="{{ Storage::url($product->file_digital) }}"></iframe>
                            </div>
                        @else
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('assets/admin/media/icons/pdf.png') }}')"></div>
                        @endif
                        <!--end::Preview existing avatar-->
                        <!--begin::Edit-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow image-input" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change data sheet') }}">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input wire:model.defer="fileDigitalTmp" class="d-none" type="file" name="" accept=".pdf" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit-->
                        @if ($fileDigitalTmp || $product->file_digital)
                            <!--begin::Remove-->
                            <span wire:click.prevent="removeFileDigital()" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        @endif
                    </div>
                    <!--end::Image input-->
                </div>
                <!-- Progress Bar -->
                <div x-show="isUploading" class="progress h-6px w-100">
                    <div class="progress-bar bg-primary" role="progressbar" :style="`width: ${progress}%;`" :aria-valuenow="`${progress}`" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--begin::Description-->
            <div class="text-muted fs-7">{{ __('Set the digital file. Only .pdf files are accepted') }}</div>
            <!--end::Description-->
            @error('fileDigitalTmp')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Card body-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Label-->
            <label class="form-label">{{ __('Downloadable') }}?</label>
            <!--end::Label-->
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input wire:model="product.downloadable" class="form-check-input" type="checkbox" value="" id="downloadable"/>
                <label class="form-check-label" for="downloadable">
                    {{ $product->downloadable ? __('Downloadable') : __('No download capability') }}
                </label>
            </div>
            @error('product.downloadable')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Card body-->
    </div>
</div>
