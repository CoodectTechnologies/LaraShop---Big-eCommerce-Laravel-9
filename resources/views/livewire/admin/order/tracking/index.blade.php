<div>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>{{ __('Guide numbers') }}</h2>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card header-->
        <div class="border-0 pt-6">
            <!--begin::Card toolbar-->
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        @include('admin.order.tracking.create')
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Button-->
                        <button
                            wire:target="sendNumberTrackings"
                            wire:click="sendNumberTrackings()"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-light-primary">
                            <span class="indicator-label"><i class="fa fa-envelope"></i> {{ __('Send guides') }}</span>
                            <span wire:loading wire:target="sendNumberTrackings" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </button>
                        <!--end::Button-->
                    </div>
                </div>
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
                            <th class="min-w-125px">{{ __('Guide') }}</th>
                            <th class="min-w-125px">{{ __('Date') }}</th>
                            <th class="min-w-125px">{{ __('Actions') }}</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($orderTrackings as $orderTracking)
                            <!--begin::Table row-->
                            <tr>
                                <td>
                                    <a href="{{ $orderTracking->link_tracking }}" target="_blank" rel="noopener noreferrer">{{ $orderTracking->number_tracking }}</a>
                                </td>
                                <td>
                                    {{ $orderTracking->dateToString() }}
                                </td>
                                <!--begin::Action=-->
                                <td class="">
                                    @include('admin.order.tracking.edit')
                                    @include('admin.order.tracking.delete')
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

            @if (
                count($order->orderTrackings) &&
                $order->send_email_track
            )
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                            <strong class="me-1">{{ __('Correct') }}</strong> {{ __('The guide email was sent successfully') }}</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
            @endif
            @if (
                count($order->orderTrackings) &&
                !$order->send_email_track &&
                $order->send_email_track_error
            )
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                                <strong class="me-1">{{ __('Information') }}!</strong>
                                {{ __('Apparently there was an error trying to send the email') }}: <br>
                                {{ $order->send_email_track_error }} <br>
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            @endif
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
