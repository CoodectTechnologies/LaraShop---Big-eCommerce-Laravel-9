<!--begin::Post card-->
<div class="card">
    <!--begin::Body-->
    <div class="card-body p-lg-20 pb-lg-0">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-xl-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-xl-15">
                <!--begin::Post content-->
                <div class="mb-17">
                    <!--begin::Wrapper-->
                    <div class="mb-8">
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap mb-6">
                            <!--begin::Item-->
                            <div class="me-9 my-1">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <span class="fw-bolder text-gray-400">{{ $project->dateToString() }}</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="me-9 my-1">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com013.svg-->
                                <span class="svg-icon svg-icon-primary svg-icon-2 me-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"/>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Label-->
                                <span class="fw-bolder text-gray-400"><a href="#views">{{ $project->viewUniques() }} Vistas</a> </span>
                                <!--end::Label-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Title-->
                        <a class="text-dark text-hover-primary fs-2 fw-bolder">{{ $project->name }}
                        <!--end::Title-->
                        <!--begin::Container-->
                        <div class="overlay mt-8">
                            <!--begin::Image-->
                            <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px" style="background-image:url('{{ $project->imagePreview() }}')"></div>
                            <!--end::Image-->
                        </div>
                        <!--end::Container-->
                        @foreach ($project->images as $image)
                            <!--begin::Container-->
                            <div class="overlay mt-8">
                                <!--begin::Image-->
                                <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px" style="background-image:url('{{ $image->imagePreview() }}')"></div>
                                <!--end::Image-->
                            </div>
                            <!--end::Container-->
                        @endforeach
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Description-->
                    <div class="fs-5 fw-bold text-gray-600">
                        <!--begin::Text-->
                        {{ $project->fragment }}
                        <!--end::Text-->
                        <hr>
                        <!--begin::Text-->
                        {!! $project->body !!}
                        <!--end::Text-->
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Post content-->
            </div>
            <!--end::Content-->
            <!--begin::Sidebar-->
            <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">
                <!--begin::Recent posts-->
                <div class="m-0">
                    <h4 class="text-black mb-7">{{ __('Recent projects') }}</h4>
                    @foreach ($recentProjects as $recentProject)
                        <!--begin::Item-->
                        <div class="d-flex flex-stack mb-7">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-60px symbol-2by3 me-4">
                                <div class="symbol-label" style="background-image: url('{{ $recentProject->imagePreview() }}')"></div>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Title-->
                            <div class="m-0">
                                <a href="{{ route('admin.portfolio.show', $recentProject) }}" class="text-dark fw-bolder text-hover-primary">{{ $recentProject->name }}</a>
                                <span class="text-gray-600 fw-bold d-block pt-1 fs-7">{{ substr($recentProject->fragment, 0, 50) }}...</span>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Item-->
                    @endforeach
                </div>
                <!--end::Recent posts-->
                <div class="mb-7">
                    <h4 class="text-black mb-2">{{ __('Client') }}</h4>
                    <p>{{ $project->client ?? 'N/A' }}</p>
                </div>
                <div class="mb-7">
                    <h4 class="text-black mb-2">Link</h4>
                    <p>
                        @if ($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer">{{ $project->link }}</a>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div class="mb-7">
                    <h4 class="text-black mb-2">{{ __('Service') }}</h4>
                    <p>{{ $project->service ? $project->service->name : 'N/A' }}</p>
                </div>
                <div class="mb-7">
                    <h4 class="text-black mb-2">{{ __('Date') }}</h4>
                    <p>{{ $project->date }}</p>
                </div>
            </div>
            <!--end::Sidebar-->
        </div>
        <!--end::Layout-->
        <!--begin::Graphic posts-->
        <div class="mb-17" id="views">
            <div class="m-0">
                <h4 class="text-black mb-7">{{ __('Statistics') }}</h4>
                <div class="" style="height: 32rem;">
                    <livewire:livewire-line-chart :line-chart-model="$lineChartModel" />
                </div>
            </div>
        </div>
        <!--end::Graphic posts-->
    </div>
    <!--end::Body-->
</div>
<!--end::Post card-->
