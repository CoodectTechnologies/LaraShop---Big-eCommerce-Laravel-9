<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <!--begin::Content-->
    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 me-5">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{ __('Search...') }}" />
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('admin.setting.shipping-zone.create') }}" class="btn btn-light-primary">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    {{ __('New') }}
                </a>
                <!--end::Button-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0" >
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-100px">Zona</th>
                            <th class="min-w-100px">Alias</th>
                            <th class="min-w-100px">{{ __('Price') }}</th>
                            <th class="min-w-100px">Gratis mayor a</th>
                            <th class="min-w-105px">{{ __('Country') }}</th>
                            <th class="min-w-150px">{{ __('State') }}s</th>
                            <th class="min-w-200px">{{ __('Shipping classes') }}</th>
                            <th class="min-w-200px">CP's</th>
                            <th class="min-w-100px">{{ __('SHIPPING DAYS') }}</th>
                            <th class="min-w-100px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($shippingZones as $shippingZone)
                        <tr>
                            <td>{{ $shippingZone->name }}</td>
                            <td>{{ $shippingZone->alias }}</td>
                            <td>{{ $shippingZone->priceToString() }}</td>
                            <td>{{ $shippingZone->priceFreeOverToString() }}</td>
                            <td>{{ $shippingZone->country ? $shippingZone->country->name : 'N/A' }}</td>
                            <td>
                                @foreach ($shippingZone->states as $estate)
                                    <a class="badge badge-light-primary fs-7 m-1">{{ $estate->name }}</a>
                                    @if ($loop->iteration >= 6)
                                        <a href="{{ route('admin.setting.shipping-zone.edit', $shippingZone) }}" class="badge badge-light-primary fs-7 m-1">+{{ count($shippingZone->states) - 6 }} </a>
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($shippingZone->shippingClasses as $shippingClass)
                                    <a class="badge badge-light-info fs-7 m-1">{{ $shippingClass->name }} ${{ number_format($shippingClass->pivot->price, 2) }}</a>
                                @endforeach
                            </td>
                            <td>
                                {{ $shippingZone->zip_codes }}
                            </td>
                            <td>
                                {{ $shippingZone->shipping_days }} {{ __('days') }}
                            </td>
                            <td>
                                <!--begin::Update-->
                                <a href="{{ route('admin.setting.shipping-zone.edit', $shippingZone) }}" class="btn btn-icon btn-active-light-success w-30px h-30px me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <!--end::Update-->
                                @include('admin.setting.shipping-zone.delete')
                            </td>
                            <!--end::Action=-->
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
            {{ $shippingZones->links() }}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
    <!--end::Content-->
</div>

