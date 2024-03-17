<!--begin::Modal - Products excel-->
<div wire:ignore.self class="modal fade" id="kt_modal_import_wordpress" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ __('Add wordpress excel file') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                @include('admin.components.errors')
                <!--begin::Form-->
                <form class="form" wire:submit.prevent="importWordpressProducts">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <label class="required form-label">{{ __('File excel') }}</label>
                        <input wire:model.defer="excelWordpressImportTmp" id="{{ $fileWordpressTmpInputId }}" required type="file" class="form-control mb-2 @error('excelWordpressImportTmp') invalid-feedback @enderror" placeholder="{{ __('File excel') }}"/>
                        <span wire:loading wire:target="excelWordpressImportTmp" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        @error('excelWordpressImportTmp')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
                        @if ($excelWordpressImportTmp)
                            <button wire:loading.attr="disabled" wire:target="importWordpressProducts" type="submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('Import') }}</span>
                                <span wire:loading wire:target="importWordpressProducts" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </button>
                        @endif
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Products excel->
