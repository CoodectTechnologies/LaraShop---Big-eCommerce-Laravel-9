<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Active?') }}</span>
            </label>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input wire:model.defer="active" class="form-check-input @error('active') invalid-feedback @enderror" type="checkbox" value="" id="flexSwitchDefault"/>
                <label class="form-check-label" for="flexSwitchDefault">

                </label>
            </div>
             @error('active') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Budget active?') }}</span>
            </label>
            <div class="form-check form-switch form-check-custom form-check-solid">
                <input wire:model.defer="budgetActive" class="form-check-input @error('budgetActive') invalid-feedback @enderror" type="checkbox" value="" id="budgetActive"/>
                <label class="form-check-label" for="budgetActive">

                </label>
            </div>
             @error('budgetActive') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
