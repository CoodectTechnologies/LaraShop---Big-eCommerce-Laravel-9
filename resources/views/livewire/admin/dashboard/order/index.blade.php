<div>
    <div class="d-flex justify-content-end mb-5">
        <!--begin::Actions-->
        <form action="{{ route('admin.dashboard.order.index') }}" class="d-flex align-items-center gap-2 gap-lg-3">
            <input name="rangeDateGrapich" value="{{ old('rangeDateGrapich', request()->rangeDateGrapich) }}" required style="width: 213px;" class="form-control rangeDateGrapich" placeholder="Selecciona el rango"/>
            <button type="submit" class="btn btn-sm btn-primary">{{ __('Apply') }}</button>
        </form>
        <!--end::Actions-->
    </div>
    <div class="row g-5 g-xl-8 pb-5">
        <div class="col-xl-4 col-6">
            <!--begin::Statistics Widget 5-->
            <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $this->orderTotalToday }} {{ $currencyDefault->code }}</div>
                    <div class="fw-bold text-gray-400">{{ __('This day') }}</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-4 col-6">
            <!--begin::Statistics Widget 5-->
            <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                    <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
                            <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
                            <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{ $this->orderTotalMonth }} {{ $currencyDefault->code }}</div>
                    <div class="fw-bold text-gray-100">{{ __('This month') }}</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
        <div class="col-xl-4 col-6">
            <!--begin::Statistics Widget 5-->
            <a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
                            <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $this->orderTotal }} {{ $currencyDefault->code }}</div>
                    <div class="fw-bold text-white">{{ $this->dateStart.' - '.$this->dateEnd }}</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget 5-->
        </div>
    </div>
    <div class="row g-5 g-xl-8 pb-5">
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-success mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-white fs-5 mb-3 d-block">{{  __('Orders procesing') }}</a>
                    <div class="py-1">
                        <span class="text-white fs-1 fw-bolder me-2">{{ count($ordersProcesing) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-primary mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-white fs-5 mb-3 d-block">{{ __('Completed orders') }}</a>
                    <div class="py-1">
                        <span class="text-white fs-1 fw-bolder me-2">{{ count($ordersCompleted) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-danger mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-white fs-5 mb-3 d-block">{{ __('Canceled orders') }}</a>
                    <div class="py-1">
                        <span class="text-white fs-1 fw-bolder me-2">{{ count($ordersCancelled) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-warning mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-white fs-5 mb-3 d-block">{{ __('Returned orders') }}</a>
                    <div class="py-1">
                        <span class="text-white fs-1 fw-bolder me-2">{{ count($ordersReturned) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
    </div>
    <div class="row g-5 g-xl-8 pb-5">
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-white mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-black fs-5 mb-3 d-block">{{ __('Published products') }}</a>
                    <div class="py-1">
                        <span class="text-black fs-1 fw-bolder me-2">{{ count($this->productsPublished) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-white mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-black fs-5 mb-3 d-block">{{ __('Draft products') }}</a>
                    <div class="py-1">
                        <span class="text-black fs-1 fw-bolder me-2">{{ count($this->productsNoPublished) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-white mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-black fs-5 mb-3 d-block">{{  __('Comment authorized') }}</a>
                    <div class="py-1">
                        <span class="text-black fs-1 fw-bolder me-2">{{ count($this->commentsApproved) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
        <div class="col-xl-3 col-6">
            <!--begin: Statistics Widget 6-->
            <div class="card bg-white mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <a class="card-title fw-bolder text-black fs-5 mb-3 d-block">{{  __('Comment not authorized') }}</a>
                    <div class="py-1">
                        <span class="text-black fs-1 fw-bolder me-2">{{ count($this->commentsNoApproved) }}</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
            <!--end: Statistics Widget 6-->
        </div>
    </div>
    <div class="col-lg-12 col-xl-12 col-xxl-12 mb-5 mb-xl-0 pb-10">
        <!--begin::Chart widget 3-->
        <div class="card card-flush overflow-hidden h-md-100">
            <div class="py-5">
                <div class="d-flex justify-content-between">
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">{{  __('Sales') }} {{ $dateStart }} - {{ $dateEnd }}</span>
                            <span class="text-gray-400 mt-1 fw-bold fs-6">{{  __('Grapih sales') }}</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <div class="p-5">
                        <div class="dropdown">
                            <button wire:loading.attr="disabled" wire:target="generateReport" class="btn btn-sm btn-light-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                {{ __('Reports') }}
                                <span wire:loading wire:target="generateReport" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($this->getReports() as $report)
                                    <li><a wire:click="generateReport('{{ $report }}')" class="dropdown-item">{{ __($report) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Card body-->
            <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                <!--begin::Statistics-->
                <div class="px-9 mb-5">
                    <!--begin::Statistics-->
                    <div class="d-flex mb-2">
                        <span class="fs-4 fw-bold text-gray-400 me-1">$</span>
                        <span class="fs-2hx fw-bolder text-gray-800 me-2 lh-1 ls-n2">{{ $this->orderTotalDates }} {{ $currencyDefault->code }}</span>
                    </div>
                    <!--end::Statistics-->
                </div>
                <!--end::Statistics-->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Chart-->
                        <div class="" style="height: 300px;">
                            <livewire:livewire-line-chart :line-chart-model="$this->grapihSales" />
                        </div>
                        <!--end::Chart-->
                    </div>
                </div>

            </div>
            <!--end::Card body-->
        </div>
        <!--end::Chart widget 3-->
    </div>
    <div class="row pb-5">
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Table Widget 4-->
            <div class="card card-flush h-xl-100">
                <!--begin::Card header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">{{  __('Orders procesing') }}</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">{{ count($ordersProcesing) }} ordenes</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Table-->
                   <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">{{  __('Number') }}</th>
                                    <th class="min-w-100px">{{ __('Date') }}</th>
                                    <th class="min-w-100px">{{ __('Total') }}</th>
                                    <th class="min-w-100px">{{ __('Payment status') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bolder text-gray-600">
                                @foreach ($ordersProcesing as $orderProcesing)
                                    <tr>
                                        <td class=""><a href="{{ route('admin.order.show', $orderProcesing) }}">{{ $orderProcesing->number }}</a></td>
                                        <td class="">{{ $orderProcesing->created_at  }}</td>
                                        <td class=""><span class="text-gray-800 fw-bolder">{{ $orderProcesing->totalToString() }}</span></td>
                                        <td class="">{!! $orderProcesing->paymentStatusToString() !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                   </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Table Widget 4-->
        </div>
        <div class="col-xl-6 mb-5 mb-xl-10">
            <!--begin::Table Widget 4-->
            <div class="card card-flush h-xl-100">
                <!--begin::Card header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">{{ __('Recent orders') }}</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">{{ __('Last 10 orders') }}</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Table-->
                   <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">{{  __('Number') }}</th>
                                    <th class="min-w-100px">{{ __('Date') }}</th>
                                    <th class="min-w-100px">{{ __('Total') }}</th>
                                    <th class="min-w-100px">{{ __('Payment status') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bolder text-gray-600">
                                @foreach ($ordersRecent as $orderRecent)
                                    <tr>
                                        <td class=""><a href="{{ route('admin.order.show', $orderRecent) }}">{{ $orderRecent->number }}</a></td>
                                        <td class="">{{ $orderRecent->created_at  }}</td>
                                        <td class=""><span class="text-gray-800 fw-bolder">{{ $orderRecent->totalToString() }}</span></td>
                                        <td class="">{!! $orderRecent->paymentStatusToString() !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                   </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Table Widget 4-->
        </div>
    </div>
    <div class="row pb-5">
        <!--begin::Col-->
        <div class="col-xl-4 mb-5 mb-xl-10">
            <!--begin::List widget 5-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">{{  __('Most selled products') }}</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">Top 10</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                        @foreach ($this->mostSelledProducts as $mostSelledProduct)
                            <!--begin::Item-->
                            <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img loading="lazy" src="{{ $mostSelledProduct->imagePreview() }}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="{{ route('admin.catalog.product.edit', $mostSelledProduct) }}" class="text-gray-800 text-hover-primary fw-bolder">{{ $mostSelledProduct->name }}</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Customer-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Name-->
                                    <span class="text-gray-400 fw-bolder">ID:
                                    <a href="{{ route('admin.catalog.product.edit', $mostSelledProduct) }}" class="text-gray-800 text-hover-primary fw-bolder">{{ $mostSelledProduct->id }}</a></span>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success">{{  __('Sales') }}: {{ $mostSelledProduct->orders()->count() }}</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Customer-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-4 mb-5 mb-xl-10">
            <!--begin::List widget 5-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">{{  __('Most viewed products') }}</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">Top 10</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                        @foreach ($this->mostViewedProducts as $mostViewedProduct)
                            <!--begin::Item-->
                            <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img loading="lazy" src="{{ $mostViewedProduct->imagePreview() }}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="{{ route('admin.catalog.product.edit', $mostViewedProduct) }}" class="text-gray-800 text-hover-primary fw-bolder">{{ $mostViewedProduct->name }}</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Customer-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Name-->
                                    <span class="text-gray-400 fw-bolder">ID:
                                    <a href="{{ route('admin.catalog.product.edit', $mostViewedProduct) }}" class="text-gray-800 text-hover-primary fw-bolder">{{ $mostViewedProduct->id }}</a></span>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light-primary">{{ __('Views') }}: {{ $mostViewedProduct->viewUniques() }}</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Customer-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-4 mb-5 mb-xl-10">
            <!--begin::List widget 5-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">{{ __('Products low stock') }}</span>
                        <span class="text-gray-400 mt-1 fw-bold fs-6">{{  __('Lower that') }} 5</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                        @foreach ($this->productsLowStock as $productLowStock)
                            <!--begin::Item-->
                            <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-stack mb-3">
                                    <!--begin::Wrapper-->
                                    <div class="me-3">
                                        <!--begin::Icon-->
                                        <img loading="lazy" src="{{ $productLowStock->imagePreview() }}" class="w-50px ms-n1 me-1" alt="" />
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <a href="{{ route('admin.catalog.product.edit', $productLowStock) }}" class="text-gray-800 text-hover-primary fw-bolder">{{ $productLowStock->name }}</a>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Customer-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Name-->
                                    <span class="text-gray-400 fw-bolder">ID:
                                    <a href="{{ route('admin.catalog.product.edit', $productLowStock) }}" class="text-gray-800 text-hover-primary fw-bolder">{{ $productLowStock->id }}</a></span>
                                    <!--end::Name-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light-warning">Cantidad: {{ $productLowStock->quantity }}</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Customer-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                    </div>
                    {{ $this->productsLowStock->links() }}
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 5-->
        </div>
        <!--end::Col-->
    </div>
    <div class="row pb-5">
        <div class="col-xl-12 mb-5 mb-xl-10">
            <!--begin::Table Widget 4-->
            <div class="card card-flush h-xl-100">
                <!--begin::Card header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">{{  __('Comment not authorized') }}</span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Table-->
                   <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-100px">{{ __('Name') }}</th>
                                    <th class="min-w-100px">{{ __('Comment') }}</th>
                                    <th class="min-w-100px">{{ __('Product') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bolder text-gray-600">
                                @foreach ($this->commentsNoApproved as $commentNoApproved)
                                    <tr>
                                        <td class="">{{ $commentNoApproved->name }}</td>
                                        <td class="">{{ $commentNoApproved->body  }}</td>
                                        <td class=""><a href="{{ route('admin.catalog.product.show', ['product' => $commentNoApproved->commentable, 'submodule' => 'comments']) }}">{{ $commentNoApproved->commentable->name }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                   </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Table Widget 4-->
        </div>
    </div>
    @push('footer')
        <script>
            $(".rangeDateGrapich").daterangepicker({
                startDate: '{{ $dateStart }}',
                endDate: '{{ $dateEnd }}',
                ranges: {
                    "Hoy": [moment(), moment()],
                    "Ayer": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Últimos 7 días": [moment().subtract(6, "days"), moment()],
                    "Últimos 30 días": [moment().subtract(29, "days"), moment()],
                    "Este mes": [moment().startOf("month"), moment().endOf("month")],
                    "Anterior mes": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                    "Este año": [moment().startOf("year"), moment().endOf("year")],
                    "Anterior año": [moment().subtract(1, "year").startOf("year"), moment().subtract(1, "year").endOf("year")],
                    "Últimos 2 años": [moment().subtract(1, "year").startOf("year"), moment().endOf("year")]
                },
                locale: {
                    format: "YYYY/MM/DD"
                }
            });

        </script>
    @endpush
</div>
