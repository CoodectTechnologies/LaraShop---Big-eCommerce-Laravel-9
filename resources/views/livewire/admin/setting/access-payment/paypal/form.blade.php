<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Status') }}</span>
            </label>
            <select wire:model.defer="paypalStatus" class="form-control form-control-solid @error('paypalStatus') invalid-feedback @enderror">
                <option value="">{{ __('Select a option') }}</option>
                <option value="true">{{ __('Active') }}</option>
                <option value="false">{{ __('Off') }}</option>
            </select>
            @error('paypalStatus') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">PayPal - Client Id</span>
            </label>
            <input wire:model.defer="paypalClientId" class="form-control form-control-solid @error('paypalClientId') invalid-feedback @enderror" placeholder="Ejem: Aaom6OSz_cvoi7C72DFaxwxKuAclEBeXA7ua-j1EenB73XoSBOIYKTcA6_uFbpJc5N46-bXehUdLVeZM" name="" />
            @error('paypalClientId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <div wire:ignore class="accordion accordion-icon-toggle" id="kt_accordion_paypal">
            <!--begin::Item-->
            <div class="mb-5">
                <!--begin::Header-->
                <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_paypal">
                    <span class="accordion-icon">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <h3 class="fs-4 fw-bold mb-0 ms-4">{{ __('Instructions') }}</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div id="kt_accordion_2_item_paypal" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_paypal">
                    <span class="badge badge-info">
                        {{ __('To find out your client id, click here:') }}
                    </span> <br>
                    <a href="https://developer.paypal.com/dashboard/applications/live" target="_blank">
                        https://developer.paypal.com/dashboard/applications/live
                    </a>
                    <span class="badge badge-secondary">{{ __('If it does not show you any access, you must first create an application in PayPal.') }} </span>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Item-->
        </div>
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
