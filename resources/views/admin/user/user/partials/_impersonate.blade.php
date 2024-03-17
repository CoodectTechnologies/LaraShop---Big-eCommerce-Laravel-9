<div>
    @if (Route::has('ecommerce.home.index'))
        <!--begin::Connected Accounts-->
        <div class="card pt-4 mb-6 mb-xl-9">
            <form action="{{ route('impersonate.signin', $user) }}" method="POST">
                    @csrf
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <div class="card-title">
                            <h3 class="fw-bolder m-0">{{ __('Log in as this user') }}</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-2">
                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-bold">
                                    <div class="fs-6 text-gray-700">{{ __('By logging in as this user you will be able to impersonate this user by obtaining his or her role and permissions.') }}</div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer border-0 d-flex justify-content-center pt-0">
                        <button type="submit" class="btn btn-lg btn-primary">
                            {{ __('Impersonation') }}
                        </button>
                    </div>
                    <!--end::Card footer-->
            </form>
        </div>
        <!--end::Connected Accounts-->
    @endif
</div>
