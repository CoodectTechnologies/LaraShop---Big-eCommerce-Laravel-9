<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>SEO</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label">{{ __('Meta tag title') }}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.meta_title.{{ translatable() }}" type="text" class="form-control mb-2 @error('product.meta_title.{{ translatable() }}') invalid-feedback @enderror" placeholder="" />
            <!--end::Input-->
            @error('product.meta_title.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--begin::Description-->
            <div class="text-muted fs-7">{{ __('Set a meta tag title. It is recommended that they be simple and precise keywords.') }}</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label">{{ __('Meta tag description') }}</label>
            <!--end::Label-->
            <!--begin::Editor-->
            <textarea wire:model.defer="product.meta_description.{{ translatable() }}" cols="10" rows="5" class="form-control @error('product.meta_description.{{ translatable() }}') invalid-feedback @enderror">{{ $product->meta_description }}</textarea>
            <!--end::Editor-->
            @error('product.meta_description.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label">{{ __('Meta tag keywords') }}</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.meta_keywords.{{ translatable() }}" type="text" class="form-control mb-2 @error('product.meta_keywords.{{ translatable() }}') invalid-feedback @enderror"/>
            <!--end::Input-->
            @error('product.meta_keywords.{{ translatable() }}')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--begin::Description-->
            <div class="text-muted fs-7">{{ __('These phrases will be used to find this product in the online store search engine. Separate key phrases by adding a comma') }}
                <code>,</code>{{ __('between each key phrase.') }}</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card header-->
</div>
