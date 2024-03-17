<div>
    <div class="d-flex justify-content-end mb-5">
        <!--begin::Actions-->
        <form action="{{ route('admin.analytic-search.index') }}" class="d-flex align-items-center gap-2 gap-lg-3">
            <input name="rangeDateGrapich" value="{{ old('rangeDateGrapich', request()->rangeDateGrapich) }}" required style="width: 213px;" class="form-control rangeDateGrapich" placeholder="Selecciona el rango"/>
            <button type="submit" class="btn btn-sm btn-primary">{{ __('Apply') }}</button>
        </form>
        <!--end::Actions-->
    </div>
    <div class="" style="height: 300px;">
        <livewire:livewire-pie-chart :pie-chart-model="$pieChartModel" />
    </div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <div class="w-100 mw-150px">
                <!--begin::Select2-->
                <select wire:model="filter" class="form-select form-select-solid">
                    <option value="">{{ __('All') }}</option>
                    <option value="{{ __('Negatives') }}">{{ __('Negatives') }}</option>
                    <option value="{{ __('Positives') }}">{{ __('Positives') }}</option>
                </select>
                <!--end::Select2-->
            </div>
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
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
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">{{ __('Searched word') }}</th>
                            <th class="min-w-100px">{{ __('Founded?') }}</th>
                            <th class="min-w-100px">{{ __('Date') }}</th>
                            <th class="min-w-100px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($analyticSearches as $analyticSearch)
                            <!--begin::Table row-->
                            <tr>
                                <td>{{ $analyticSearch->search }}</td>
                                <td>
                                    @if ($analyticSearch->founded)
                                        <span class="badge badge-success">{{ __('Yes') }}</span>
                                    @else
                                        <span class="badge badge-warning">NO</span>
                                    @endif
                                </td>
                                <td>{{ $analyticSearch->dateToString() }}</td>
                                <!--begin::Action=-->
                                <td class="">
                                    @include('admin.analytic-search.show')
                                    @include('admin.analytic-search.delete')
                                </td>
                                <!--end::Action=-->
                            </tr>
                            <!--end::Table row-->
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
            {{ $analyticSearches->links() }}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
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
                    format: "YYYY-MM-DD"
                }
            });
        </script>
    @endpush
</div>
