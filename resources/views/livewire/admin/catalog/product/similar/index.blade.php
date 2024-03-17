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
                @include('admin.catalog.product.similar.create')
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
                            <th class="min-w-125px">{{ __('Product') }}</th>
                            <th class="min-w-125px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($similars as $productSimilar)
                            <!--begin::Table row-->
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div class="symbol symbol-50px overflow-hidden me-3">
                                            <a href="{{ route('admin.catalog.product.show', $productSimilar->product) }}">
                                                <div class="symbol-label">
                                                    <img loading="lazy" src="{{ $productSimilar->product->imagePreview() }}" alt="{{ $productSimilar->product->name }}" class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.catalog.product.show', $productSimilar->product) }}" class="text-gray-800 text-hover-primary mb-1">{{ $productSimilar->product->name }}</a>
                                            <span>{{ $productSimilar->product->type }}</span>
                                        </div>
                                        <!--begin::User details-->
                                    </div>
                                </td>
                                <td class="">
                                    @include('admin.catalog.product.similar.delete')
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
