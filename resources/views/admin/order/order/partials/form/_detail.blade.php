<div class="card card-flush py-4">
    <div class="card-body pt-0">
        <div class="border-0 d-flex justify-content-between align-items-center my-4">
            <h3 class="card-title fw-bolder text-dark">{{ __('Details') }}</h3>
        </div>
        <div class="d-flex flex-column gap-10">
            <!--begin::Input group-->
            <div class="fv-row">
                <!--begin::Label-->
                <label class="required form-label">{{ __('Payment method') }}</label>
                <!--end::Label-->
                <!--begin::Select-->
                <select wire:model.defer="order.payment_method" class="form-select mb-2" name="payment_method">
                    <option value="">{{ __('Select a option') }}</option>
                    <option value="Transfer">{{ __('Bank transfer or deposit') }}</option>
                    <option value="Stripe">Stripe</option>
                    <option value="PayPal">PayPal</option>
                    <option value="MercadoPago">Mercado pago</option>
                    <option value="PayPal">Paypal</option>
                </select>
                <!--end::Select-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div wire:ignore class="fv-row">
                <!--begin::Label-->
                <label class="form-label">{{ __('User') }}</label>
                <!--end::Label-->
                <!--begin::Select-->
                <select class="userId form-select mb-2" name="user" id="user" data-placeholder="Select a option">
                    <option value="">{{ __('Select a option') }}</option>
                    @foreach ($users as $usr)
                        <option value="{{ $usr->id }}">{{ $usr->name }} - ({{ $usr->email }})</option>
                    @endforeach
                </select>
                <!--end::Select-->
            </div>
            <!--end::Input group-->
        </div>
    </div>
</div>
