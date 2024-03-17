<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Country code') }}</span>
            </label>
            <input wire:model.defer="country.code" class="form-control form-control-solid @error('country.code') invalid-feedback @enderror" placeholder="Ejem: MX" name="" />
            @error('country.code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Country name') }}</span>
            </label>
            <input wire:model.defer="country.name" class="form-control form-control-solid @error('country.name') invalid-feedback @enderror" placeholder="Ejem: México" name="" />
            @error('country.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Telephone code') }}</span>
            </label>
            <input wire:model.defer="country.phonecode" class="form-control form-control-solid @error('country.phonecode') invalid-feedback @enderror" placeholder="Ejem: 52" name="" />
            @error('country.phonecode') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Status') }}</span>
            </label>
            <!--begin::Select2-->
            <select required wire:model.defer="country.status" class="form-select mb-2 @error('country.status') invalid-feedback @enderror">
                <option value="">{{ __('Select a option') }}</option>
                <option value="1">{{ __('Active') }}</option>
                <option value="0">{{ __('Inactive') }}</option>
            </select>
            <!--end::Select2-->
            @error('country.status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Card body-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Default</span>
            </label>
            <!--begin::Select2-->
            <select required wire:model.defer="country.default" class="form-select mb-2 @error('country.default') invalid-feedback @enderror">
                <option value="">{{ __('Select a option') }}</option>
                <option value="1">{{ __('Yes') }}</option>
                <option value="0">NO</option>
            </select>
            <!--end::Select2-->
            @error('country.default')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Card body-->
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
