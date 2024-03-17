<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Information') }}</span>
                </label>
                <textarea required wire:model.defer="about.information.{{ translatable() }}" class="form-control form-control-solid @error('about.information.{{ translatable() }}') invalid-feedback @enderror" cols="30" rows="10">{{ $about->information }}</textarea>
                @error('about.information.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Mission') }}</span>
                </label>
                <textarea required wire:model.defer="about.mission.{{ translatable() }}" class="form-control form-control-solid @error('about.mission.{{ translatable() }}') invalid-feedback @enderror" cols="30" rows="10">{{ $about->mission }}</textarea>
                @error('about.mission.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Vision') }}</span>
                </label>
                <textarea required wire:model.defer="about.vision.{{ translatable() }}" class="form-control form-control-solid @error('about.vision.{{ translatable() }}') invalid-feedback @enderror" cols="30" rows="10">{{ $about->vision }}</textarea>
                @error('about.vision.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Values') }}</span>
                </label>
                <input type="text" required  wire:model.defer="about.values.{{ translatable() }}" class="form-control form-control-solid @error('about.values.{{ translatable() }}') invalid-feedback @enderror">
                <span class="badge badge-light">{{ __('Each value will be separated with a') }} </span><code>,</code>
                @error('about.values.{{ translatable() }}') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
</div>
