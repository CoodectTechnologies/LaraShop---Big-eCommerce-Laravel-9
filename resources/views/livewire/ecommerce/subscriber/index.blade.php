<div>
    <div class="footer-newsletter bg-primary pt-6 pb-6">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="icon-box icon-box-side text-white">
                        <div class="icon-box-icon d-inline-flex">
                            <i class="w-icon-envelop3"></i>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white text-uppercase mb-0">{{ __('Subscribe to our Newsletter') }}</h4>
                            <p class="text-white">
                                {{ __('Get all the latest information about our offers.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                    @if (session()->has('alert-subscriber'))
                        <div class="alert alert-{{ session()->get('alert-type-subscriber') }} alert-simple alert-inline">
                            <h4 class="alert-title">{{ session()->get('alert-subscriber') }}</h4>
                        </div>
                    @endif
                    <form wire:submit.prevent="store" class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                        <input wire:model.defer="email" type="email" class="form-control mr-2 bg-white" name="email" id="email" placeholder="{{ __('Enter your email address') }}" />
                        <button wire:loading.attr="disabled" wire:target="store" class="btn btn-dark btn-rounded" type="submit">
                            {{ __('Subscribe') }}
                            <span wire:loading.class="spinner-grow" wire:target="store"></span>
                            <i wire:loading.class.remove="w-icon-long-arrow-right"></i>
                        </button>
                    </form>
                    @error('email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
