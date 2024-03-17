<!--begin::Orders-->
<div class="d-flex flex-column gap-7 gap-lg-10">
    <div class="row">
        <div class="col-lg-6">
            <!--begin::Order history-->
            <div class="card card-flush my-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Payment identifier') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    @if ($order->payment_id)
                        <h4>
                            {{ $order->payment_method }} <br>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#payment_method_details">
                                {{ $order->payment_id }} <i class="fa fa-eye"></i>
                            </a>
                        </h4>
                    @else
                        {{ __('None') }}
                    @endif
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Order history-->
            @livewire('admin.order.email.resend', ['order' => $order], key('re-send-'.$order->id))
        </div>
        <div class="col-lg-6">
            @livewire('admin.order.status.form', ['order' => $order], key('status-'.$order->id))
            @livewire('admin.order.tracking.index', ['order' => $order], key('order-tracking-'.$order->id))
        </div>
    </div>
</div>
<!--end::Orders-->

<!--begin::Modal -->
<div wire:ignore.self class="modal fade" id="payment_method_details" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">{{ __('Payment details') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
               <pre>
                    @json(json_decode($order->payment_data), JSON_PRETTY_PRINT)
                </pre>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add permissions-->
