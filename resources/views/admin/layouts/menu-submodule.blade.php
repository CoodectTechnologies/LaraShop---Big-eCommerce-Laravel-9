
@if(Route::has($submodule['urlName']))
    <div class="menu-item">
        <a class="menu-link {{ active($submodule['active']) }}" href="{{ route($submodule['urlName']) }}">
            <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
            </span>
            <span class="menu-title">{{ __($submodule['name']) }}</span>
        </a>
    </div>
@endif
