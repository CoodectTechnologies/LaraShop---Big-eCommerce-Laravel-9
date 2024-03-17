<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title">
            <h2>{{ __('Status') }}</h2>
        </div>
        <!--end::Card title-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Select2-->
        <select required wire:model.defer="product.status" class="form-select mb-2 @error('product.status') invalid-feedback @enderror">
            <option value="Publicado">{{ __('Published') }}</option>
            <option value="Borrador">{{ __('Draft') }}</option>
        </select>
        <!--end::Select2-->
        @error('product.status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
    </div>
    <!--end::Card body-->
</div>
