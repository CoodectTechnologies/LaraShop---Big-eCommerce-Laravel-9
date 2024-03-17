<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Aside mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Aside mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('admin.dashboard.general.index') }}" class="d-lg-none">
                <img loading="lazy" src="{{ asset(config('app.logo')) }}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
            <!--begin::Navbar-->
            <div class="d-flex align-items-stretch" id="kt_header_nav">
                <!--begin::Menu wrapper-->
                <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                    <!--begin::Menu-->
                    <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                        <a href="{{ route('admin.dashboard.general.index') }}" class="menu-item here show menu-lg-down-accordion me-lg-1">
                            <span class="menu-link py-3">
                                <span class="menu-title">Dashboard</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </span>
                        </a>
                        @if (Route::has('admin.order.index'))
                            @can('ordenes')
                                <a href="{{ route('admin.order.index') }}" class="menu-item menu-lg-down-accordion me-lg-1">
                                    <span class="menu-link py-3">
                                        <span class="menu-title">{{ __('Orders') }}</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </span>
                                </a>
                            @endcan
                        @endif
                        @if (Route::has('admin.blog.post.index'))
                            @can('blog')
                                <a href="{{ route('admin.blog.post.index') }}" class="menu-item menu-lg-down-accordion me-lg-1">
                                    <span class="menu-link py-3">
                                        <span class="menu-title">Blogs</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </span>
                                </a>
                            @endcan
                        @endif
                        @if (Route::has('admin.catalog.product.index'))
                            @can('productos')
                                <a href="{{ route('admin.catalog.product.index') }}" class="menu-item menu-lg-down-accordion me-lg-1">
                                    <span class="menu-link py-3">
                                        <span class="menu-title">{{ __('Products') }}</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </span>
                                </a>
                            @endcan
                        @endif
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Menu wrapper-->
            </div>
            <!--end::Navbar-->
            <!--begin::Toolbar wrapper-->
            <div class="d-flex align-items-stretch flex-shrink-0">
                <!--begin::Visit website-->
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    @if (Route::has('ecommerce.home.index'))
                        <!--begin::Drawer toggle-->
                        <a href="{{ route('ecommerce.home.index') }}" target="_blank" rel="noopener noreferrer">
                            <div class="btn btn-icon btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px" id="kt_activities_toggle">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-12-26-231111/core/html/src/media/icons/duotune/ecommerce/ecm004.svg-->
                                <span title="E-COMMERCE" class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/>
                                    <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/>
                                    <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </a>
                        <!--end::Drawer toggle-->
                    @endif
                </div>
                <!--end::Visit website-->
                <!--begin::Notifications-->
                @livewire('admin.layouts.notification', key('notifications'))
                <!--end::Notifications-->
                <!--begin::User menu-->
                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <img loading="lazy" src="{{ auth()->user()->imagePreview() }}" alt="{{ auth()->user()->name }}" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="{{ auth()->user()->name }}" src="{{ auth()->user()->imagePreview() }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                        {{ auth()->user()->name }}
                                    </div>
                                    <a class="fw-bold text-muted text-hover-primary fs-7">
                                        {{ auth()->user()->email }}
                                    </a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('admin.user.show', auth()->user()) }}" class="menu-link px-5">{{ __("My profile") }}</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('admin.user.show', ['user' => auth()->user(), 'submodule' => 'notifications']) }}" class="menu-link px-5">{{ __("My notifications") }}</a>
                        </div>
                        <!--end::Menu item-->
                        @if(count(languages()) && Route::has('admin.language'))
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                <a href="#" class="menu-link px-5">
                                    <span class="menu-title position-relative">{{ __("Language") }}
                                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">{{ Str::upper(language()) }}
                                    <img class="w-15px h-15px rounded-1 ms-2" src="{{ languages()[language()]['flag'] }}" alt="" /></span></span>
                                </a>
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    @foreach (languages() as $locale => $language)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.language', $locale) }}" class="menu-link d-flex px-5 {{ language() == $locale ? 'active' : '' }}">
                                                <span class="symbol symbol-20px me-4">
                                                    <img class="rounded-1" src="{{ $language['flag'] }}" alt="" />
                                                </span>
                                                {{ Str::upper($locale) }}
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    @endforeach
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                        @endif

                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5">{{ __("Log out") }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
</div>
