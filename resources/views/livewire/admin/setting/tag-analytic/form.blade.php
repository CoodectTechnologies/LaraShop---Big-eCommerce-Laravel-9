<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <!--begin::Content-->
    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
               <h2 class="card-title">{{ __("Analytical tags") }} (Google Analytics, Google Tag Manager, Pixel, Etc.)</h2>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <div class="card-body pt-5" >
            @include('admin.components.errors')
            <!--begin::Form-->
            <form class="form" wire:submit.prevent="{{ $method }}">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">Etiquetas en el encabezado de la web</span>
                    </label>
                    <textarea wire:model.defer="tagAnalytic.header" cols="30" rows="10" class="form-control form-control-solid @error('tagAnalytic.header') invalid-feedback @enderror" name=""></textarea>
                    @error('tagAnalytic.header') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">Etiquetas en el pie de página</span>
                    </label>
                    <textarea wire:model.defer="tagAnalytic.footer" cols="30" rows="10" class="form-control form-control-solid @error('tagAnalytic.footer') invalid-feedback @enderror" name=""></textarea>
                    @error('tagAnalytic.footer') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
</div>
