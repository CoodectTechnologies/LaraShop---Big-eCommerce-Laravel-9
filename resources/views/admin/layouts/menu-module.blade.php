{{-- (Validar si el módulo tiene ruta principal, y de ser así validar si existe) o pasará si no tiene ruta principal  --}}
@if(
    ($module['urlName'] && Route::has($module['urlName'])) ||
    (!$module['urlName'] && moduleMenuIsVisible($module))
)
    {{-- Validar si la persona tiene algún permiso del módulo, si no tiene dejará pasar por si existen rutas que no se requieran permisos --}}
    @canany($module['canany'])
        <div
            @if(count($module['submodules'])) data-kt-menu-trigger="click" @endif
            class="menu-item @if(count($module['submodules'])) menu-accordion @endif {{ active($module['active']) }}"
            >
            <a href="{{ $module['urlName'] ? route($module['urlName']) : '#' }}" class="menu-link {{ active($module['active']) }}">
                @if (isset($module['icon']))
                    <span class="menu-icon">
                        <i class="{{ $module['icon'] }}"></i>
                    </span>
                @else
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                @endif
                <span class="menu-title">{{ __($module['name']) }}</span>
                @if(count($module['submodules']))
                    <span class="menu-arrow"></span>
                @endif
            </a>
            @if(count($module['submodules']))
                <div class="menu-sub menu-sub-accordion menu-active-bg">
                    @foreach($module['submodules'] as $submodule)
                        @canany($submodule['canany'])
                            @if (count($submodule['submodules']))
                                @include('admin.layouts.menu-module', ['module' => $submodule])
                            @else
                                @include('admin.layouts.menu-submodule', ['submodule' => $submodule])
                            @endif
                        @endcanany
                    @endforeach
                </div>
            @endif
        </div>
    @endcanany
@endif
