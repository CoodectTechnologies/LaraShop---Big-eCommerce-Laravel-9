<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <!--begin::Content-->
    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                @include('admin.setting.configurator.edit')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
        <div class="card-body p-5 px-lg-19 py-lg-16">
            <!--begin::Content main-->
            <div class="mb-14">
                <!--begin::Heading-->
                <div class="mb-15">
                    <!--begin::Title-->
                    <h1 class="fs-2x text-dark mb-6">{{ __('Information') }}</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-info me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                            <strong class="me-1">{{ __('Information') }} </strong> {{ __('If enabled, a new menu will appear in the online store.') }}</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                <!--begin::Body-->
                <div class="mb-20 pb-lg-20">
                    <h2 class="fw-bolder text-dark mb-7">{{ __('Active?') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        {{ config('configurator.active') ? __('ON') : __('OFF') }}
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">{{ __('Budget active?') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        {{ config('configurator.budget_active') ? __('ON') : __('OFF') }}
                    </div>

                </div>
                <!--end::Body-->
            </div>
            <!--end::Content main-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::About card-->
    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
