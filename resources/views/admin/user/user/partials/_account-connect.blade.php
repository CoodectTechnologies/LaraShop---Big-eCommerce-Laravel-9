 <!--begin::Connected Accounts-->
 <div class="card pt-4 mb-6 mb-xl-9">
    <form action="" wire:submit.prevent="syncConnectAcount">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <div class="card-title">
                <h3 class="fw-bolder m-0">{{ __('Connected account') }}</h3>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-2">
            <!--begin::Notice-->
            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                <!--begin::Icon-->
                <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z" fill="black" />
                        <path d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1">
                    <!--begin::Content-->
                    <div class="fw-bold">
                        <div class="fs-6 text-gray-700">{{ __('By connecting the account you will be able to log in through the associated platform.') }}</div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Notice-->
            <!--begin::Items-->
            <div class="py-2">
                <!--begin::Item-->
                <div class="d-flex flex-stack">
                    <div class="d-flex">
                        <img loading="lazy" src="{{ asset('assets/admin') }}/media/svg/brand-logos/google-icon.svg" class="w-30px me-6" alt="" />
                        <div class="d-flex flex-column">
                            <a class="fs-5 text-dark fw-bolder">Google</a>
                            <div class="fs-6 fw-bold text-muted">{{ __('To be able to enter by this means') }}</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input wire:model.defer="connectAcountGoogle" class="form-check-input" name="" type="checkbox"/>
                            <!--end::Input-->
                            <!--end::Label-->
                        </label>
                        <!--end::Switch-->
                    </div>
                </div>

            </div>
            <!--end::Items-->
        </div>
        <!--end::Card body-->
        <!--begin::Card footer-->
        <div class="card-footer border-0 d-flex justify-content-center pt-0">
            <button wire:loading.attr="disabled" wire:target="syncConnectAcount" type="submit" class="btn btn-sm btn-light-primary">
                {{ __('Save changes') }}
                <span wire:loading wire:target="syncConnectAcount" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
        </div>
        <!--end::Card footer-->
    </form>
</div>
<!--end::Connected Accounts-->
