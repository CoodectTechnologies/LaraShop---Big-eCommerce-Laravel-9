<!--begin::Shipping addresses-->
<div class="py-4">
    <div class="mb-xl-8 mt-xl-8">
        <div class="border-0">
            <h3 class="card-title fw-bolder text-dark">{{ __('Shipping addresses') }}</h3>
            <hr>
        </div>
    </div>
    @error('order.shipping_address_id')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
    <div class="card-body pt-0">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
            <div class="col-md-4">
                <div class="card h-md-100">
                    <div class="card-body d-flex flex-center">
                        <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_shipping_address">
                            <img loading="lazy" src="{{ asset('assets/admin') }}/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                            <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">{{ __('Add new address') }}</div>
                        </button>
                    </div>
                </div>
            </div>
            @foreach ($shippingAddresses as $sa)
                <div class="col-md-4">
                    <div class="card card-flush h-md-100">
                        <div class="card-header ribbon ribbon-top ribbon-vertical">
                            <div class="card-title">
                                <h2>{{ $sa['street'] }}</h2>
                            </div>
                            @if ($sa['default'])
                                <div class="ribbon-label bg-success">
                                    <i class="bi bi-heart-fill fs-2 text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body pt-1">
                            <div class="fw-bolder text-gray-600 mb-5">{{ __('Total orders with this address') }}: {{ count($sa['orders']) }}</div>
                            <div class="d-flex flex-column text-gray-600">
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-dark me-3"></span>{{ $sa['state']['country']['name'] }}
                                </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-dark me-3"></span>{{ $sa['state']['name'] }}
                                </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-dark me-3"></span>{{ $sa['municipality'] }}
                                </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-dark me-3"></span>{{ $sa['colony'] }}
                                </div>
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-dark me-3"></span>{{ $sa['zip_code'] }}
                                </div>
                            </div>
                            @if ((count($shippingAddress) && $shippingAddress['id'] != $sa['id']) || (!count($shippingAddress)))
                                <button class="btn btn-success" type="button" wire:click="selectShippingAddress({{ $sa['id'] }})">
                                    {{ __('Ship here') }}
                                    <span wire:loading wire:target="selectShippingAddress({{ $sa['id'] }})" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </button>
                            @endif
                            @if (count($shippingAddress) && $shippingAddress['id'] == $sa['id'])
                                <div class="card-title">
                                    <h2 class="text-success">{{ __('Selected') }}</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--begin::Accordion-->
    <div wire:ignore.self class="accordion accordion-icon-toggle" id="kt_accordion_shipping_billing">
        <!--begin::Item-->
        <div class="mb-5">
            <!--begin::Header-->
            <div wire:ignore.self class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_shipping_billing_item_1">
                <span class="accordion-icon"><span class="svg-icon svg-icon-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                    </svg>
                </span></span>
                <h3 class="fs-4 fw-bold mb-0 ms-4">{{ __('Billing?') }}</h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div wire:ignore.self id="kt_accordion_shipping_billing_item_1" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_shipping_billing">
                <div class="mb-xl-8 mt-xl-8">
                    <div class="border-0">
                        <h3 class="card-title fw-bolder text-dark">{{ __('Billing addresses') }}</h3>
                        <hr>
                    </div>
                </div>
                @error('order.billing_address_id')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <div class="card-body pt-0">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                        <div class="col-md-4">
                            <div class="card h-md-100">
                                <div class="card-body d-flex flex-center">
                                    <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_billing_address">
                                        <img loading="lazy" src="{{ asset('assets/admin') }}/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                                        <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">{{ __('Add new address') }}</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @foreach ($billingAddresses as $ba)
                            <div class="col-md-4">
                                <div class="card card-flush h-md-100">
                                    <div class="card-header ribbon ribbon-top ribbon-vertical">
                                        <div class="card-title">
                                            <h2>{{ $ba['street'] }}</h2>
                                        </div>
                                        @if ($ba['default'])
                                            <div class="ribbon-label bg-success">
                                                <i class="bi bi-heart-fill fs-2 text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body pt-1">
                                        <div class="fw-bolder text-gray-600 mb-5">{{ __('Total orders with this address') }}: {{ count($ba['orders']) }}</div>
                                        <div class="d-flex flex-column text-gray-600">
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-dark me-3"></span>{{ $ba['state']['country']['name'] }}
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-dark me-3"></span>{{ $ba['state']['name'] }}
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-dark me-3"></span>{{ $ba['municipality'] }}
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-dark me-3"></span>{{ $ba['colony'] }}
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-dark me-3"></span>{{ $ba['zip_code'] }}
                                            </div>
                                        </div>
                                        @if ((count($billingAddress) && $billingAddress['id'] != $ba['id']) || (!$billingAddress))
                                            <button class="btn btn-success" type="button" wire:click="selectBillingAddress({{ $ba['id'] }})">
                                                {{ __('Select this') }}
                                                <span wire:loading wire:target="selectBillingAddress({{ $ba['id'] }})" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </button>
                                        @endif
                                        @if (count($billingAddress) && $billingAddress['id'] == $ba['id'])
                                            <div class="card-title">
                                                <h2 class="text-success">{{ __('Selected') }}</h2>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Item-->
    </div>
    <!--end::Accordion-->


</div>
<!--end::Shipping addresses-->
