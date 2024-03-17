@if($shippingApplies)
    <div class="mb-xl-5">
        <div class="border-0">
            <h3 class="card-title fw-bolder text-dark">{{ __('Shipping methods') }}</h3>
            <hr>
        </div>
    </div>
    @error('shippingZoneId')
        <small class="form-text text-danger" role="alert">{{ $message }}</small>
    @enderror
    <div class="fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
        <!--begin::Row-->
        <div class="row">
            @forelse ($shippingZones as $sz)
                <div class="col-lg-6">
                    <input wire:model="shippingZoneId" type="radio" class="btn-check" name="shippingZoneId" value="{{ $sz['id'] }}" id="shipping-zone-{{ $sz['id'] }}">
                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center mb-10" for="shipping-zone-{{ $sz['id'] }}">
                        <!--begin::Svg Icon | path: assets/media/icons/duotune/ecommerce/ecm006.svg-->
                        <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="black"/>
                            <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <span class="d-block fw-bold text-start">
                            <span class="text-dark fw-bolder d-block fs-4 mb-2">{{ $sz['name'] }}</span>
                            <span class="text-muted fw-bold fs-6">${{ number_format($sz['price'], 2) }} ({{ $sz['days'].' '.__('days').' '.$sz['estimatedDate'] }}) </span>
                        </span>
                    </label>
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
            @empty
                <div class="alert alert-dismissible bg-warning d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                    <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"></path>
                            <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"></path>
                        </svg>
                    </span>
                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                        <h4 class="mb-2 text-light">Aviso</h4>
                        <span>{{ __('There appear to be no shipping methods in your area.') }}</span>
                    </div>
                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                        <span class="svg-icon svg-icon-2x svg-icon-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                            </svg>
                        </span>
                    </button>
                </div>
            @endforelse
        </div>
        <!--end::Row-->
    </div>
@endif
