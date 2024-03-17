{{-- CUPON --}}
<div class="" id="formCoupon">
    <div class="row">
        <div class="pr-lg-4 mb-4 border-right">
        </div>
        <div class="pl-lg-4 mb-4 sticky-sidebar-wrapper">
            <div class="pb-5">
                {{ __('Have a coupon?') }}
                <a wire:click.prevent="toogleCoupon" href="#" class="font-weight-bold text-uppercase text-dark">
                    {{ __('Enter your code') }} <span wire:target="toogleCoupon" wire:loading.class="ml-4 load-more-overlay loading"></span>
                </a>
            </div>
            <div class="coupon-content mb-4" style="{{ $couponRequire ? 'display: block' : 'display: none' }}">
                @if (session()->has('alert-coupon'))
                    <div class="alert alert-{{ session()->get('alert-coupon-type') }} alert-simple alert-inline">
                        <h4 class="alert-title">{{ session()->get('alert-coupon') }}</h4>
                    </div>
                @endif
                <p>{{ __('If you have a coupon code, please apply it below.') }}</p>
                <div class="input-wrapper-inline">
                    <input wire:model.defer="couponCode" type="text" name="couponCode" class="form-control form-control-md mr-1 mb-2 @error('couponCode') invalid-feedback @enderror" placeholder="{{ __('Coupon code') }}" id="coupon_code">
                    <button type="button" wire:click="applyCoupon" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon">{{ __('Apply Coupon') }}</button>
                </div>
                @error('couponCode') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
        </div>
    </div>
</div>
