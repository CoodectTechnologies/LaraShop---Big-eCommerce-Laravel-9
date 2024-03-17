<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a wire:ignore.self class="nav-link text-active-primary pb-4 {{ $submodule === null ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_user_view_overview_tab">{{ __('General') }}</a>
    </li>
    <!--end:::Tab item-->
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a wire:ignore.self class="nav-link text-active-primary pb-4 {{ $submodule == 'notifications' ? 'active' : '' }}" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_notification">{{ __('Notifications') }}</a>
    </li>
    <!--end:::Tab item-->
    @if (Route::has('admin.order.index'))
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a wire:ignore.self class="nav-link text-active-primary pb-4 {{ $submodule == 'shipping-address' ? 'active' : '' }}" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_shipping_address">{{ __('Addresses') }}</a>
        </li>
        <!--end:::Tab item-->
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a wire:ignore.self class="nav-link text-active-primary pb-4 {{ $submodule == 'orders' ? 'active' : '' }}" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_orders">{{ __('Orders') }}</a>
        </li>
        <!--end:::Tab item-->
    @endif
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a wire:ignore.self class="nav-link text-active-primary pb-4 {{ $submodule == 'logs' ? 'active' : '' }}" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_events_and_logs_tab">Logs</a>
    </li>
    <!--end:::Tab item-->
</ul>
