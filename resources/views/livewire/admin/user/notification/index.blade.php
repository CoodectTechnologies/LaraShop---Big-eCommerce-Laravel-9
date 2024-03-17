<div>
    <!--begin::List Widget 6-->
    <div class="card card-xl-stretch mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title fw-bolder text-dark">{{ __('Notifications') }}</h3>
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
                <div wire:ignore.self class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                    <!--begin::Heading-->
                    <div class="menu-item px-3">
                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">{{ __('Options') }}</div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" wire:click="markAllAsRead" class="menu-link px-3">{{ __('Clear notifications') }}</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" wire:click="$set('filterReadAt', 'Sin leer')" class="menu-link px-3">{{ __('Unread') }}</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" wire:click="$set('filterReadAt', 'Leidas')" class="menu-link px-3">{{ __('See readings') }}</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu 3-->
                <!--end::Menu-->
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0">
            @forelse ($notifications as $notification)
                 <!--begin::Item-->
                <div class="d-flex align-items-center bg-light-{{ $notification->data['type'] }} rounded p-5 mb-7">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-{{ $notification->data['type'] }} me-5">
                        <i class="{{ $notification->data['icon'] }} text-{{ $notification->data['type'] }}"></i>
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2">
                        <a href="#" wire:click="markAndRedirect('{{ $notification->id }}', '{{ $notification->data["url"] }}')" class="fw-bolder text-gray-800 text-hover-{{ $notification->data['type'] }} fs-6">{{ $notification->data['title'] }}</a>
                        <span class="text-muted fw-bold d-block">{!! $notification->data['body'] !!}</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Lable-->
                    <span class="text-muted fw-bold d-block py-1">{{ $notification->created_at }}</span>
                    <!--end::Lable-->
                </div>
                <!--end::Item-->
            @empty
                <p class="text-gray-400 text-center">{{ __('No news') }}</p>
            @endforelse
            {{ $notifications->links() }}
        </div>
        <!--end::Body-->
    </div>
    <!--end::List Widget 6-->
</div>
