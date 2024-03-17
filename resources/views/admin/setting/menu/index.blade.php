<!--begin::Sidebar-->
<div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 mb-lg-0">
    <!--begin::Sticky aside-->
    <div class="card-flush mb-0">
        <!--begin::Aside content-->
        <div class="card-body">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                @foreach(config('menu-setting') as $menu)
                    @if(sectionMenuIsVisible($menu['section']))
                        <div class="menu-item">
                            <div class="menu-content pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ __($menu['section']['name']) }}</span>
                            </div>
                        </div>
                        @foreach($menu['section']['modules'] as $module)
                            @if (Route::has($module['urlName']))
                                @canany($module['canany'])
                                    <!--begin::Menu item-->
                                    <div class="menu-item mb-3">
                                        <a href="{{ route($module['urlName']) }}">
                                            <span class="menu-link {{ active($module['urlName']) }}">
                                                <span class="menu-icon">
                                                    <i class="{{ $module['icon'] }}"></i>
                                                </span>
                                                <span class="menu-title fw-bolder">{{ __($module['name']) }}</span>
                                            </span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                @endcan
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside content-->
    </div>
    <!--end::Sticky aside-->
</div>
<!--end::Sidebar-->
