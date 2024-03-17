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
                @include('admin.catalog.product.color.create')
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
                            <th class="min-w-125px">{{ __('Quantity') }}</th>
                            <th class="min-w-125px">Medidas</th>
                            <th class="min-w-125px">{{ __('Date') }}</th>
                            <th class="min-w-125px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($colors as $color)
                        <!--begin::Table row-->
                        <tr>
                            <td>{{ $color->name }}</td>
                            <td>{{ $color->quantity }}</td>
                            <td class="fw-bolder">
                                @foreach ($color->productSizes as $size)
                                <a class="badge badge-light-primary fs-7 m-1">{{ $size->name }}</a>
                                @endforeach
                            </td>
                            <td>
                               {{ $color->dateToString() }}
                            </td>
                            <!--begin::Action=-->
                            <td class="">
                                @include('admin.catalog.product.color.edit')
                                @include('admin.catalog.product.color.delete')
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
