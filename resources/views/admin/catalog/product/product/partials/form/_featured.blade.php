<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __('Featured') }}</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Select2-->
        <select wire:model.defer="product.featured" class="form-select mb-2 @error('product.featured') invalid-feedback @enderror">
            <option value="0">No</option>
            <option value="1">{{ __('Yes') }}</option>
        </select>
        <!--end::Select2-->
        @error('product.featured')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
    </div>
    <!--end::Card body-->
</div>
