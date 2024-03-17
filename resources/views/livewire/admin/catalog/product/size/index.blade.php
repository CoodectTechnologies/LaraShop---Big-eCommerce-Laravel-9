<div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                @include('admin.catalog.product.size.create')
            </div>
            <!--end::Card toolbar-->
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
                            <th class="min-w-125px">{{ __('Name') }}</th>
                            <th class="min-w-125px">{{ __('Price') }}</th>
                            <th class="min-w-125px">{{ __('Quantity') }}</th>
                            <th class="min-w-125px">{{ __('Date') }}</th>
                            <th class="min-w-125px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($sizes as $size)
                        <!--begin::Table row-->
                        <tr>
                            <td>{{ $size->name }}</td>
                            <td>{!! $size->getPriceToString() !!}</td>
                            <td>
                                @if ($size->relation_with_colors != 'SI')
                                    {{ $size->quantity }}
                                @else
                                    @foreach ($size->productColors as $color)
                                        <span class="badge badge-light-primary fs-7 m-1">{{ $color->name }} : {{ $color->pivot->quantity }}</span>,
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $size->dateToString() }}</td>
                            <!--begin::Action=-->
                            <td class="">
                                @include('admin.catalog.product.size.edit')
                                @include('admin.catalog.product.size.delete')
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
</div>
