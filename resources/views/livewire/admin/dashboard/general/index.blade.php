<div>
<!--begin::Row-->
<div class="row g-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-xl-4 mb-xl-10">
        <!--begin::Lists Widget 19-->
        <div class="card card-flush h-xl-100">
            <!--begin::Heading-->
            <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('{{ asset('assets/admin/media/svg/shapes/top-green.png') }}')">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column text-white pt-15">
                    <span class="fw-bolder fs-2x mb-3">{{ __('Hello') }} {{ auth()->user()->name }}</span>
                    <div class="fs-4 text-white">
                        <span class="opacity-75">{{ __('Quick summary') }}</span>
                    </div>
                </h3>
                <!--end::Title-->
            </div>
            <!--end::Heading-->
            <!--begin::Body-->
            <div class="card-body mt-n20">
                <!--begin::Stats-->
                <div class="mt-n20 position-relative">
                    <!--begin::Row-->
                    <div class="row g-3 g-lg-6">
                        @if (Route::has('admin.blog.post.index'))
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <!--begin::Svg Icon | path: icons/duotune/medicine/med005.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <i class="fa fa-book text-primary"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $this->blogPostsCount }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-bold fs-6">{{ __('Posts') }}</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        @endif
                        @if (Route::has('admin.order.index'))
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <i class="fa fa-shopping-cart text-primary"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $this->ordersCount }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-bold fs-6">{{ __('Orders') }}</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        @endif
                        <!--begin::Col-->
                        @if (
                            Route::has('admin.blog.post.index') ||
                            Route::has('admin.catalog.product.index')
                        )
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <i class="fa fa-comments text-primary"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $this->commentsCount }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-bold fs-6">{{ __('Comments') }}</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        @endif
                        @if (Route::has('admin.email-web.index'))
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen013.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <i class="fa fa-envelope text-primary"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-boldest d-block fs-2qx lh-1 ls-n1 mb-1">{{ $this->emailsWebCount }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-bold fs-6">{{ __('Webmails') }}</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        @endif
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Lists Widget 19-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-xl-8 mb-5 mb-xl-10">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10">
            @if (Route::has('admin.order.index'))
                <!--begin::Col-->
                <div class="col-xl-6 mb-xl-10">
                    <!--begin::Slider Widget 1-->
                    <div id="kt_sliders_widget_1_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h4 class="card-title d-flex align-items-start flex-column">
                                <span class="card-label fw-bolder text-gray-800">{{ __('Last 3 orders') }}</span>
                            </h4>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Carousel Indicators-->
                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                                    @foreach ($this->orders as $order)
                                        <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->iteration == 1 ? 'active' : '' }} ms-1"></li>
                                    @endforeach
                                </ol>
                                <!--end::Carousel Indicators-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Carousel-->
                            <div class="carousel-inner mt-n5">
                                @foreach ($this->orders as $order)
                                    <!--begin::Item-->
                                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active show' : '' }}">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-70px symbol-circle me-5">
                                                <span class="symbol-label bg-light-success">
                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs025.svg-->
                                                    <span class="svg-icon svg-icon-3x svg-icon-success">
                                                        <i class="fa fa-shopping-cart text-success fa-2x"></i>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Subtitle-->
                                                <h4 class="fw-bolder text-gray-800 mb-3">#{{ $order->number }}</h4>
                                                <!--end::Subtitle-->
                                                <!--begin::Items-->
                                                <div class="d-flex d-grid gap-5">
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-column flex-shrink-0 me-4">
                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bolder fs-7">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                                <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                                        <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                            <!--end::Svg Icon--> {{ __('Status') }}: {{ $order->status  }}
                                                        </span>
                                                        <!--end::Section-->
                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bolder fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                            <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->{{ __('Payment status') }}: {{ $order->payment_status }}
                                                        </span>
                                                        <!--end::Section-->
                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bolder fs-7">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                            <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                                    <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->{{ __('Products') }}: {{ $order->products->sum('quantity') }}
                                                        </span>
                                                        <!--end::Section-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Action-->
                                        <div class="mb-1">
                                            <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-secondary">{{ __('View all') }}</a>
                                            <a href="{{ route('admin.order.show', $order) }}" class="btn btn-sm btn-primary">{{ __('View order') }}</a>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Item-->
                                @endforeach
                            </div>
                            <!--end::Carousel-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Slider Widget 1-->
                </div>
                <!--end::Col-->
            @endif
            @if (Route::has('admin.blog.post.index'))
                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <!--begin::Slider Widget 2-->
                    <div id="kt_sliders_widget_2_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5500">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h4 class="card-title d-flex align-items-start flex-column">
                                <span class="card-label fw-bolder text-gray-800">{{ __('Last 3 post') }}</span>
                            </h4>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Carousel Indicators-->
                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-success">
                                    @foreach ($this->blogPosts as $blogPost)
                                        <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->iteration == 1 ? 'active' : '' }} ms-1"></li>
                                    @endforeach
                                </ol>
                                <!--end::Carousel Indicators-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Carousel-->
                            <div class="carousel-inner">
                                @foreach ($this->blogPosts as $blogPost)
                                    <!--begin::Item-->
                                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active show' : '' }}">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center mb-9">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-70px symbol-circle me-5">
                                                <span class="symbol-label bg-light-success">
                                                    <i class="fa fa-book text-success fa-2x"></i>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Subtitle-->
                                                <h4 class="fw-bolder text-gray-800 mb-3">{{ $blogPost->name }}</h4>
                                                <!--end::Subtitle-->
                                                <!--begin::Items-->
                                                <div class="d-flex d-grid gap-5">
                                                    <!--begin::Item-->
                                                    <div class="d-flex flex-column flex-shrink-0 me-4">
                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center fs-7 fw-bolder text-gray-400 mb-2">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                        <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                                <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->{{ __('Views') }}: {{ $blogPost->viewUniques() }}</span>
                                                        <!--end::Section-->
                                                        <!--begin::Section-->
                                                        <span class="d-flex align-items-center text-gray-400 fw-bolder fs-7">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen057.svg-->
                                                        <span class="svg-icon svg-icon-6 svg-icon-gray-600 me-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                                                <path d="M11.9343 12.5657L9.53696 14.963C9.22669 15.2733 9.18488 15.7619 9.43792 16.1204C9.7616 16.5789 10.4211 16.6334 10.8156 16.2342L14.3054 12.7029C14.6903 12.3134 14.6903 11.6866 14.3054 11.2971L10.8156 7.76582C10.4211 7.3666 9.7616 7.42107 9.43792 7.87962C9.18488 8.23809 9.22669 8.72669 9.53696 9.03696L11.9343 11.4343C12.2467 11.7467 12.2467 12.2533 11.9343 12.5657Z" fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->{{ __('Comments') }}: {{ $blogPost->comments->count() }}</span>
                                                        <!--end::Section-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Items-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Action-->
                                        <div class="mb-1">
                                            <a href="{{ route('admin.blog.post.index') }}" class="btn btn-sm btn-secondary">{{ __('View all') }}</a>
                                            <a href="{{ route('admin.blog.post.show', $blogPost) }}" class="btn btn-sm btn-success">{{ __("View post") }}</a>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Item-->
                                @endforeach
                            </div>
                            <!--end::Carousel-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Slider Widget 2-->
                </div>
                <!--end::Col-->
            @endif
        </div>
        <!--end::Row-->
        @if (
            Route::has('admin.dashboard.order.index') ||
            Route::has('admin.dashboard.blog.index') ||
            Route::has('admin.dashboard.email-web.index')
        )
            <!--begin::Engage widget 4-->
            <div class="card" style="background: #1C325E;">
                <!--begin::Body-->
                <div class="card-body d-flex ps-xl-15">
                    <!--begin::Action-->
                    <div class="m-0">
                        <!--begin::Title-->
                        <div class="position-relative fs-2x z-index-2 fw-bolder text-white mb-7">
                        <span class="me-2">{{ __('Welcome to the general dashboard') }},
                        <span class="position-relative d-inline-block text-danger">
                            <a class="text-danger opacity-75-hover">{{ __('you have other dashboards') }}</a>
                            <!--begin::Separator-->
                            <span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-danger border-bottom w-100"></span>
                            <!--end::Separator-->
                        </span></span>{{ __('Where would you like to go?.') }}
                        <br /></div>
                        <!--end::Title-->
                        <!--begin::Action-->
                        <div class="mb-3">
                            @if (Route::has('admin.dashboard.order.index')):
                                <a href='{{ route('admin.dashboard.order.index') }}' class="btn btn-danger fw-bold me-2">{{ __('Orders') }}</a>
                            @endif
                            @if (Route::has('admin.dashboard.blog.index')):
                                <a href="{{ route('admin.dashboard.blog.index') }}" class="btn btn-danger fw-bold me-2">{{ __('Blog') }}</a>
                            @endif
                            @if (Route::has('admin.dashboard.email-web.index')):
                                <a href="{{ route('admin.dashboard.email-web.index') }}" class="btn btn-danger fw-bold me-2">{{ __('Emails') }}</a>
                            @endif
                        </div>
                        <!--begin::Action-->
                    </div>
                    <!--begin::Action-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Engage widget 4-->
        @endif
    </div>
    <!--end::Col-->
</div>
<!--end::Row-->
    <!--begin::Row-->
    <div class="row gy-5 g-xl-8">
        @if (Route::has('admin.setting.log'))
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::List Widget 3-->
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0">
                        <h3 class="card-title fw-bolder text-dark">{{ __('Activity') }}</h3>
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--begin::Menu 3-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                <!--begin::Heading-->
                                <div class="menu-item px-3">
                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">{{ __('Actions') }}</div>
                                </div>
                                <!--end::Heading-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.user.show', ['user' => auth()->user(), 'submodule' => 'logs']) }}" class="menu-link px-3">{{ __('See all my history') }}</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu 3-->
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        @foreach ($this->logs as $log)
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-vertical h-40px bg-success"></span>
                                <!--end::Bullet-->
                                <!--begin::Description-->
                                <div class="flex-grow-1 ms-4">
                                    <a class="text-gray-800 text-hover-primary fw-bolder fs-6">{{ $log->log_name }}</a>
                                    <span class="text-muted fw-bold d-block">{{ $log->description }}</span>
                                </div>
                                <!--end::Description-->
                                <span class="badge badge-light-success fs-8 fw-bolder">{{ $log->created_at }}</span>
                            </div>
                            <!--end:Item-->
                        @endforeach
                    </div>
                    <!--end::Body-->
                </div>
                <!--end:List Widget 3-->
            </div>
            <!--end::Col-->
        @endif
        @if (Route::has('admin.email-web.index'))
            <!--begin::Col-->
            <div class="col-xl-8">
                <!--begin::Tables Widget 9-->
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">{{ __('Latest web emails') }}</span>
                            <span class="text-muted mt-1 fw-bold fs-7">{{ $this->emailsWebCount }}</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="min-w-200px">{{ __('Name') }}</th>
                                        <th class="min-w-150px">{{ __('email') }}</th>
                                        <th class="min-w-150px">{{ __('Phone') }}</th>
                                        <th class="min-w-150px">{{ __('Message') }}</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($this->emailsWeb as $emailWeb)
                                        <tr>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $emailWeb->name }}</span>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $emailWeb->email }}" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $emailWeb->email }}</a>
                                            </td>
                                            <td>
                                                <a href="tel:{{ $emailWeb->phone }}" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $emailWeb->phone }}</a>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $emailWeb->body }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
                <!--end::Tables Widget 9-->
            </div>
            <!--end::Col-->
        @endif
    </div>
    <!--end::Row-->
</div>
