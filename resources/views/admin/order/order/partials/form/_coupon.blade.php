<!--begin::Invoices-->
<div class="card card-xxl-stretch mb-5 mb-xxl-10">
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">
            <h3 class="text-gray-800">{{ __('Coupon') }}</h3>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
        <span class="fs-5 fw-bold text-gray-600 pb-6 d-block">{{ __('If you have a coupon code, please apply it below.') }}</span>
        <!--begin::Left Section-->
        <div class="d-flex align-self-center">
            <div class="flex-grow-1 me-3">
                <!--begin::Select-->
                <input wire:model="couponCode" class="form-select form-select-solid" name="couponCode" placeholder="{{ __('Coupon code') }}"/>
                <!--end::Select-->
            </div>
            <!--begin::Action-->
            <button type="button" wire:click="applyCoupon" class="btn btn-primary flex-shrink-0 {{ $coupon ? 'd-none' : '' }}">
                {{ __('Apply Coupon') }}
                <span wire:loading wire:target="applyCoupon" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
            <!--end::Action-->
            <!--begin::Action-->
            <button type="button" wire:click="cancelCoupon" class="btn btn-danger flex-shrink-0 {{ !$coupon ? 'd-none' : '' }}">
                {{ __('Cancel coupon') }}
                <span wire:loading wire:target="cancelCoupon" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
            <!--end::Action-->
        </div>
        <!--end::Left Section-->
        @error('couponCode') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
    </div>
    <!--end::Body-->
</div>
<!--end::Invoices-->
