<div>
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Summary-->
                    <!--begin::User Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <img loading="lazy" src="{{ $user->imagePreview() }}" alt="{{ $user->name }}" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">{{ $user->name }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="mb-9">
                            <!--begin::Badge-->
                            @foreach ($user->roles as $role)
                                <div class="badge badge-lg badge-light-primary d-inline">{{ $role->name }}</div>
                            @endforeach
                            <!--begin::Badge-->
                        </div>
                        <!--end::Position-->
                        @if (Route::has('admin.order.index'))
                            <!--begin::Info-->
                            <!--begin::Info heading-->
                            <div class="fw-bolder mb-3">{{ __('Orders') }}
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Total de ordenes realizadas e ingresos obtenidos."></i>
                            </div>
                            <!--end::Info heading-->
                            <div class="d-flex flex-wrap flex-center">
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                    <div class="fs-4 fw-bolder text-gray-700">
                                        <span class="w-75px">{{ $user->ordersCount() }}</span>
                                    </div>
                                    <div class="fw-bold text-muted">{{ __('Orders') }}</div>
                                </div>
                                <!--end::Stats-->
                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                    <div class="fs-4 fw-bolder text-gray-700">
                                        <span class="w-50px">${{ number_format($user->ordersIncome(), 2) }}</span>
                                    </div>
                                    <div class="fw-bold text-muted">{{ __('Income') }}</div>
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        @endif
                    </div>
                    <!--end::User Info-->
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">{{ __('Details') }}
                        <span class="ms-2 rotate-180">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span></div>
                    </div>
                    <!--end::Details toggle-->
                    <div class="separator"></div>
                    <!--begin::Details content-->
                    <div id="kt_user_view_details" class="collapse show">
                        <div class="pb-5 fs-6">
                            <!--begin::Details item-->
                            <div class="fw-bolder mt-5">{{ __('Account') }} ID</div>
                            <div class="text-gray-600">ID-{{ $user->id }}</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bolder mt-5">{{ __('email') }}</div>
                            <div class="text-gray-600">
                                <a href="mailto:{{ $user->email }}" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
                            </div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bolder mt-5">{{ __('Date') }}</div>
                            <div class="text-gray-600">{{ $user->dateToString() }}</div>
                            <!--begin::Details item-->
                        </div>
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            @include('admin.user.user.partials._impersonate')
        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            @include('admin.user.menu.index')
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent" wire:ignore.self>
                <!--begin:::Tab pane-->
                <div wire:ignore.self class="tab-pane fade {{ $submodule === null ? 'show active' : '' }}" id="kt_user_view_overview_tab" role="tabpanel">
                   @include('admin.user.user.partials._profile')
                   @include('admin.user.permission.index')
                   @if (Route::has('login.google'))
                        @include('admin.user.user.partials._account-connect')
                    @endif
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div wire:ignore.self class="tab-pane fade {{ $submodule === 'notifications' ? 'show active' : '' }}" id="kt_user_view_overview_notification" role="tabpanel">
                    @include('admin.user.notification.index')
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div wire:ignore.self class="tab-pane fade {{ $submodule === 'shipping-address' ? 'show active' : '' }}" id="kt_user_view_overview_shipping_address" role="tabpanel">
                    @include('admin.user.shipping-address.index')
                    @include('admin.user.shipping-billing.index')
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div wire:ignore.self class="tab-pane fade {{ $submodule === 'orders' ? 'show active' : '' }}" id="kt_user_view_overview_orders" role="tabpanel">
                   @include('admin.user.order.index')
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div wire:ignore.self class="tab-pane fade {{ $submodule === 'logs' ? 'show active' : '' }}" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
                    <!--begin::Card-->
                    @include('admin.user.log.index')
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>
    @push('footer')
    <script>
        Livewire.on('render', function(){
            $('.modal').modal('hide');
        });
    </script>
    @endpush
</div>
