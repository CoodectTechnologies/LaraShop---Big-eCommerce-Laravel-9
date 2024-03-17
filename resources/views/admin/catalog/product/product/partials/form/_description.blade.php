<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Content') }}</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div wire:ignore>
            <!--begin::Editor-->
            <textarea wire:model.defer="product.description.{{ translatable() }}" cols="10" rows="5" class="form-control ckeditor5 @error('product.description.{{ translatable() }}') invalid-feedback @enderror">{{ $product->body }}</textarea>
            <!--end::Editor-->
        </div>
        <!--end::Input group-->
        @error('product.description.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
    </div>
    <!--end::Card header-->
</div>
