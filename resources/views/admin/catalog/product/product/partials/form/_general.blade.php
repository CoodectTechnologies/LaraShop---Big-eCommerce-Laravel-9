<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('General') }}</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--end::Input group-->
        <div class="row">
            <!--begin::Input group-->
            <div class="mb-10 fv-row col-lg-6">
                <!--begin::Label-->
                <label class="required form-label">{{ __('Name') }}</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input wire:model.defer="product.name.{{ translatable() }}" required type="text" class="form-control mb-2 @error('product.name.{{ translatable() }}') invalid-feedback @enderror" placeholder="Nombre del producto"/>
                <!--end::Input-->
                @error('product.name.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Description-->
                <div class="text-muted fs-7">{{ __('A product name is required and is recommended to be unique.') }}</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row col-lg-6">
                <!--begin::Label-->
                <label class="required form-label">{{ __('Price') }}</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input wire:model.defer="product.price" type="text" class="form-control mb-2 @error('product.price') invalid-feedback @enderror" placeholder="{{ __('Price') }}"/>
                <!--end::Input-->
                @error('product.price')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            </div>
            <!--end::Input group-->
        </div>
        <div class="row">
            <!--begin::Input group-->
            <div class="mb-10 fv-row col-lg-6">
                <!--begin::Label-->
                <label class="form-label">{{ __('Quantity') }}</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input wire:model.defer="product.quantity" type="number" class="form-control mb-2 @error('product.quantity') invalid-feedback @enderror" placeholder="{{ __('Quantity') }}"/>
                <!--end::Input-->
                @error('product.quantity')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Description-->
                <div class="text-muted fs-7">{{ __('If this field is left empty, it is considered that there will be no product limit.') }}</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row col-lg-6">
                <!--begin::Label-->
                <label class="form-label">{{ __('SKU') }}</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input wire:model.defer="product.sku" type="text" class="form-control mb-2 @error('product.sku') invalid-feedback @enderror" placeholder="SKU"/>
                <!--end::Input-->
                @error('product.sku')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Input group-->
        <!--begin::Input group-->
        <div class="mb-10 fv-row col-lg-12">
            <!--begin::Label-->
            <label class="form-label">Iframe YouTube</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.iframe_url" type="text" class="form-control mb-2 @error('product.iframe_url') invalid-feedback @enderror" placeholder="iframe_url"/>
            <!--end::Input-->
            @error('product.iframe_url')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Input group-->
        <div class="mb-10 fv-row col-lg-12">
            <!--begin::Label-->
            <label class="form-label">{{ __('Little description') }}</label>
            <!--end::Label-->
            <!--begin::Editor-->
            <textarea wire:model.defer="product.detail.{{ translatable() }}" cols="10" rows="5" class="form-control @error('product.detail.{{ translatable() }}') invalid-feedback @enderror">{{ $product->detail }}</textarea>
            <!--end::Editor-->
            @error('product.detail.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Input group-->
        <div class="mb-10 fv-row col-lg-12">
            <!--begin::Label-->
            <label class="form-label">{{ __('Advanced search phrases') }}</label>
            <!--end::Label-->
            <!--begin::Editor-->
            <textarea wire:model.defer="product.search_advanced.{{ translatable() }}" cols="10" rows="5" class="form-control @error('product.search_advanced.{{ translatable() }}') invalid-feedback @enderror">{{ $product->search_advanced }}</textarea>
            <!--end::Editor-->
            @error('product.search_advanced.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--begin::Description-->
            <div class="text-muted fs-7">{{ __('These phrases will be used to find this product in the online store search engine. Separate key phrases by adding a comma') }}
                <code>,</code>{{ __('between each key phrase.') }}</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card header-->
</div>
