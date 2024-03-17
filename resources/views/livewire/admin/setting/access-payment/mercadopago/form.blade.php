<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">{{ __('Status') }}</span>
            </label>
            <select wire:model.defer="mercadoStatus" class="form-control form-control-solid @error('mercadoStatus') invalid-feedback @enderror">
                <option value="">{{ __('Select a option') }}</option>
                <option value="true">{{ __('Active') }}</option>
                <option value="false">{{ __('Off') }}</option>
            </select>
            @error('mercadoStatus') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Public key</span>
            </label>
            <input wire:model.defer="mercadoPagoKey" class="form-control form-control-solid @error('mercadoPagoKey') invalid-feedback @enderror" placeholder="Ejem: 392bbf59-0a4b-4a7d-a096-5cf6548de48b " name="" />
            @error('mercadoPagoKey') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Private key</span>
            </label>
            <input wire:model.defer="mercadoPagoToken" class="form-control form-control-solid @error('mercadoPagoToken') invalid-feedback @enderror" placeholder="Ejem: 7535429537422278-051316-7d8ac1be3db19378a2e27f1330a8200e-1123244856" name="" />
            @error('mercadoPagoToken') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Country code') }}</span>
            </label>
            <select wire:model.defer="mercadoPagoCountryCode" class="form-control form-control-solid @error('mercadoPagoCountryCode') invalid-feedback @enderror">
                @foreach ($this->countriesCodeAllowed() as $countryCode)
                    <option value="{{ $countryCode }}">{{ $countryCode }}</option>
                @endforeach
            </select>
            @error('mercadoPagoCountryCode') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">{{ __('Currency code') }}</span>
            </label>
            <select wire:model.defer="mercadoPagoCurrencyCode" class="form-control form-control-solid @error('mercadoPagoCurrencyCode') invalid-feedback @enderror">
                @foreach ($this->currenciesCodeAllowed() as $currencyCode)
                    <option value="{{ $currencyCode }}">{{ $currencyCode }}</option>
                @endforeach
            </select>
            @error('mercadoPagoCurrencyCode') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <div wire:ignore class="accordion accordion-icon-toggle" id="kt_accordion_mercadopago">
            <!--begin::Item-->
            <div class="mb-5">
                <!--begin::Header-->
                <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_mercadopago">
                    <span class="accordion-icon">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <h3 class="fs-4 fw-bold mb-0 ms-4">{{ __('Instructions') }}</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div id="kt_accordion_2_item_mercadopago" class="collapse fs-6 ps-10" data-bs-parent="#kt_accordion_mercadopago">
                    <span class="badge badge-info">
                        {{ __('To find out what your credentials are, click here:') }}
                    </span> <br>
                    <a href="https://mercadopago.com.mx/developers/panel/credentials/share" target="_blank">
                        https://mercadopago.com.mx/developers/panel/credentials/share
                    </a>
                    <div class="alert alert-info mt-3">
                        {{ __('After entering your credentials, you will have to activate the webhook of mercado pago') }} <br>
                        {{ __('To do so, follow the steps below:') }}
                        <ul>
                            <li>{{ __('Click on the following link') }} <a href="https://www.mercadopago.com.mx/developers/panel/app" target="_blank">https://www.mercadopago.com.mx/developers/panel/app</a></li>
                            <li>{{ __('If no application has been created, you must create an application.') }}</li>
                            <li>{{ __("Once the application is created, you will be redirected inside the app, look for the link that says 'Webhooks' and click on it.") }}</li>
                            <li>{{ __("You must enter the following in the 'Production mode' field:") }} <strong>{{ route('ecommerce.webhook.payment.mercadopago') }}</strong> </li>
                            <li>{!! __("Click on '+ Select events' and look for <strong>Payments</strong> and select it.") !!}</li>
                            <li>{{ __("To finish click on 'Save'. Your Mercado Pago configuration is now complete.") }}</li>
                        </ul>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Item-->
        </div>
        <!--begin::Actions-->
        <div class="text-center pt-15">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
            <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                <span class="indicator-label">{{ __('Save changes') }}</span>
                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
