<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1"><script>document.write(new Date().getFullYear())</script>©</span>
            @if (Route::has('web.home.index'))
                <a href="{{ route('web.home.index') }}" target="_blank" class="text-gray-800 text-hover-primary">{{ config('app.name') }}</a>
            @endif
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
            <li class="menu-item">
                <a href="https://coodect.com" target="_blank" class="menu-link px-2">{{ __("Developed by: Coodect Technologies") }}</a>
            </li>
            <li class="menu-item">
                <a href="mailto:hola@coodect.com" target="_blank" class="menu-link px-2">{{ __("Support") }}</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
