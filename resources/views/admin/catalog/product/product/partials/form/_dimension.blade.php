<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Dimensions') }}</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Shipping form-->
        <div class="mt-10">
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="form-label">{{ __('Weight') }} (KG)</label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input wire:model.defer="product.weight_kl" type="number" step="0.01" pattern="^\d*(\.\d{0,2})?$" name="weight_kl" class="form-control mb-2 @error('product.weight_kl') invalid-feedback @enderror" placeholder="Ejem: 2"/>
                <!--end::Editor-->
                @error('product.weight_kl')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Description-->
                <div class="text-muted fs-7">{{ __('Establish product weight in kilograms') }} (kg)</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="form-label">{{ __('Weight') }} (GR)</label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input wire:model.defer="product.weight_gr" type="number" step="0.01" pattern="^\d*(\.\d{0,2})?$" name="weight_gr" class="form-control mb-2 @error('product.weight_gr') invalid-feedback @enderror" placeholder="Ejem: 2000"/>
                <!--end::Editor-->
                @error('product.weight_gr')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Description-->
                <div class="text-muted fs-7">{{ __('Establish a product weight in grams') }} (gr)</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row">
                <!--begin::Label-->
                <label class="form-label">{{ __('Dimesions') }}</label>
                <!--end::Label-->
                <!--begin::Input-->
                <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                    <input wire:model.defer="product.width" type="number" step="0.01" pattern="^\d*(\.\d{0,2})?$" name="width" class="form-control mb-2" placeholder="{{ __('Width') }} (CM)"/>
                    @error('product.width')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    <input wire:model.defer="product.height" type="number" step="0.01" pattern="^\d*(\.\d{0,2})?$" name="height" class="form-control mb-2" placeholder="{{ __('height') }} (CM)"/>
                    @error('product.height')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    <input wire:model.defer="product.length" type="number" step="0.01" pattern="^\d*(\.\d{0,2})?$" name="length" class="form-control mb-2" placeholder="{{ __('length') }} (CM)"/>
                    @error('product.length')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                </div>
                <!--end::Input-->
                <!--begin::Description-->
                <div class="text-muted fs-7">{{ __('Enter product dimensions in centimeters') }} (cm).</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Shipping form-->
    </div>
    <!--end::Card header-->
</div>
