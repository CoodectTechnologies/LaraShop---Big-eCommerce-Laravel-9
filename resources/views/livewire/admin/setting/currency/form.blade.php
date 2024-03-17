<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Name of currency') }}</span>
            </label>
            <input wire:model.defer="currency.name" class="form-control form-control-solid @error('currency.name') invalid-feedback @enderror" placeholder="Ejem: Dolar" />
            @error('currency.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Code of currency') }}</span>
            </label>
            <input wire:model.defer="currency.code" class="form-control form-control-solid @error('currency.code') invalid-feedback @enderror" placeholder="Ejem: USD" />
            @error('currency.code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Value') }}</span>
            </label>
            <input wire:model.defer="currency.value" type="number" step="0.000000001" class="form-control form-control-solid @error('currency.value') invalid-feedback @enderror" placeholder="{{ __('Currency value') }} Ejem: 0.058029581" />
            @error('currency.value') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Symbol') }}</span>
            </label>
            <input wire:model.defer="currency.symbol" class="form-control form-control-solid @error('currency.symbol') invalid-feedback @enderror" placeholder="Ejem: $" />
            @error('currency.symbol') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Default</span>
            </label>
            <select wire:model.defer="currency.default" class="form-control form-control-solid @error('currency.default') invalid-feedback @enderror">
                <option value="">{{ __('Select a option') }}</option>
                <option value="1">{{ __('Yes') }}</option>
                <option value="0">No</option>
            </select>
            @error('currency.default') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Active') }}</span>
            </label>
            <select wire:model.defer="currency.active" class="form-control form-control-solid @error('currency.active') invalid-feedback @enderror">
                <option value="1">{{ __('Active') }}</option>
                <option value="0">{{ __('Inactive') }}</option>
            </select>
            @error('currency.active') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
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
