<div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-5 g-xl-9">
        @include('admin.user.shipping-billing.create')
        @foreach ($billingAddresses as $billingAddress)
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100">
                    <!--begin::Card header-->
                    <div class="card-header ribbon ribbon-top ribbon-vertical">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ $billingAddress->street }}</h2>
                        </div>
                        <!--end::Card title-->
                        @if ($billingAddress->default)
                            <div class="ribbon-label bg-success">
                                <i class="bi bi-heart-fill fs-2 text-white"></i>
                            </div>
                        @endif
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        <!--begin::shipping orders count-->
                        <div class="fw-bolder text-gray-600 mb-5">{{ __('Total orders with this address') }}: {{ count($billingAddress->orders) }}</div>
                        <!--end::shipping orders count-->
                        <!--begin::Info-->
                        <div class="d-flex flex-column text-gray-600">
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-dark me-3"></span>{{ $billingAddress->state->country->name }}
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-dark me-3"></span>{{ $billingAddress->state->name }}
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-dark me-3"></span>{{ $billingAddress->municipality }}
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-dark me-3"></span>{{ $billingAddress->colony }}
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-dark me-3"></span>{{ $billingAddress->zip_code }}
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-0">
                        @include('admin.user.shipping-billing.edit')
                        @include('admin.user.shipping-billing.delete')
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endforeach
    </div>
    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
