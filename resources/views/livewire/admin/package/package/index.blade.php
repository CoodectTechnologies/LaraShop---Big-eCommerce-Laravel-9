<div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                @include('admin.package.package.create')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Row-->
            <div class="row g-10">
                @foreach ($packages as $package)
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <div class="d-flex h-100 align-items-center">
                            <!--begin::Option-->
                            <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">
                                <!--begin::Heading-->
                                <div class="mb-7 text-center">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-5 fw-boldest">{{ $package->title }}</h1>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="text-gray-400 fw-bold mb-5">{{ $package->subtitle }}</div>
                                    <!--end::Description-->
                                    @if ($package->price)
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="mb-2 text-primary">$</span>
                                            <span class="fs-3x fw-bolder text-primary" data-kt-plan-price-month="{{ $package->price }}" data-kt-plan-price-annual="3399">{{ $package->price }}</span>
                                        </div>
                                        <!--end::Price-->
                                    @endif
                                </div>
                                <!--end::Heading-->
                                <!--begin::Features-->
                                <div class="w-100 mb-10">
                                    @foreach ($package->packageFeatures as $packageFeature)
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ $packageFeature->name }}</span>
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                                    <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <!--end::Item-->
                                    @endforeach
                                </div>
                                <!--end::Features-->
                                <div class="d-flex">
                                    @include('admin.package.package.edit')
                                    @include('admin.package.package.delete')
                                </div>
                            </div>
                            <!--end::Option-->
                        </div>
                    </div>
                    <!--end::Col-->
                @endforeach
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
