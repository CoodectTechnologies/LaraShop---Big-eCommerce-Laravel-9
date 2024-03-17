<div class="payment-methods" id="">
    <h3 class="">{{ __('Payment methods') }}</h3>
    <div class="accordion payment-accordion">
        @if (config('services.transfer.status'))
            <div data-target="#modal" data-toggle="modal" class="card" style="cursor: pointer">
                <div class="card-header d-flex justify-content-center">
                    <a href="#" class="">{{ __('Bank transfer or deposit') }}</a>
                </div>
            </div>
        @endif
        @if (
            config('services.stripe.status') &&
            config('services.stripe.public') &&
            config('services.stripe.secret')
        )
            <div onclick="location='{{ $stripeURL }}'" class="card" style="cursor: pointer">
                <div class="card-header d-flex justify-content-center">
                    <a href="">
                        <img width="180" src="{{ asset('assets/admin/media/method_payment/processout.svg') }}" alt="Stripe">
                        {{-- {{ __('Stripe') }} --}}
                    </a>
                </div>
            </div>
        @endif
    </div>
    @if (
            config('services.mercadopago.status') &&
            config('services.mercadopago.key') &&
            config('services.mercadopago.token') &&
            strtolower($order->currency) == strtolower(config('services.mercadopago.currency_code'))
        )
            <div class="text-center mb-3">
                Ó
            </div>
            <div class="" id="mercadopago-button"></div>
        @endif
    @if (
        config('services.paypal.status') &&
        config('services.paypal.client_id')
    )
        <div class="text-center mb-3">
            Ó
        </div>
        <div class="" id="paypal-button"></div>
    @endif
    @error('paymentMethod') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
</div>

{{-- MODAL TRANSFER --}}
<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">Depósito o transferencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            Da clic en "Finalizar compra” y recibirás por correo electrónico la información que necesitas para realizar el pago con depósito o transferencia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    wire:click="paymentTransfer"
                    wire:target="paymentTransfer"
                    wire:loading.class="load-more-overlay loading"
                    wire:loading.disabled
                    type="button"
                    class="btn btn-dark btn-block btn-rounded">
                    <div wire:loading.remove wire:target="paymentTransfer"><span> {{ __('Finalize purchase') }} <i class="ml-3 fa fa-arrow-right"></i></span></div>
                    <div wire:loading wire:target="paymentTransfer"><span> {{ __('Finalizing purchase') }} ...</span></div>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end: Modal -->
