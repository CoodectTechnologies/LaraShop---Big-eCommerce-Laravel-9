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
                @include('admin.setting.popup.edit')
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
                            <strong class="me-1">{{ __('Information') }} </strong> {{ __('This popup will appear in the start module if enabled.') }}</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                <!--begin::Body-->
                <!--begin::Block-->
                <div class="mb-20 pb-lg-20">
                    <h2 class="fw-bolder text-dark mb-7">{{ __('Active?') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        {{ $popup->active ? __('ON') : __('OFF') }}
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">{{ __('Image') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        @if ($popup->imagePreview())
                            <img width="300" src="{{ asset($popup->imagePreview()) }}" alt="">
                        @else
                            {{ __('Without image') }}
                        @endif
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">{{ __('Title') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        @if ($popup->title)
                            <span class="badge badge-primary">{{ $popup->title }}</span>
                        @else
                            <span class="badge badge-secondary">{{ __('Without title') }}</span>
                        @endif
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">{{ __('Subtitle') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        @if ($popup->subtitle)
                            <span class="badge badge-primary">{{ $popup->subtitle }}</span>
                        @else
                            <span class="badge badge-secondary">{{ __('Without subtitle') }}</span>
                        @endif
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">{{ __('Description') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        @if ($popup->description)
                            <span class="badge badge-primary">{{ $popup->description }}</span>
                        @else
                            <span class="badge badge-secondary">{{ __('Without description') }}</span>
                        @endif
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">{{ __('Text button') }}</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        @if ($popup->btn_text)
                            <span class="badge badge-primary">{{ $popup->btn_text }}</span>
                        @else
                            <span class="badge badge-secondary">{{ __('Without text') }}</span>
                        @endif
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">URL</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        @if ($popup->btn_url)
                            <span class="badge badge-primary">{{ $popup->btn_url }}</span>
                        @else
                            <span class="badge badge-secondary">{{ __('Without url') }}</span>
                        @endif
                    </div>

                    <h2 class="fw-bolder text-dark mb-7">NEWSLETTER</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        @if ($popup->newsletter)
                            <span class="badge badge-primary">{{ __('Yes') }}<span>
                        @else
                            <span class="badge badge-secondary">NO</span>
                        @endif
                    </div>
                </div>
                <!--end::Block-->
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
