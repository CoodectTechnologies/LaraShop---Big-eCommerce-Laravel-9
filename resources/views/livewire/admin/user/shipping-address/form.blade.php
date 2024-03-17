<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div wire:ignore.self class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_shipping_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_shipping_address_header" data-kt-scroll-wrappers="#kt_modal_add_shipping_address_scroll" data-kt-scroll-offset="300px">
            <div class="fv-row mb-7">
                <!--begin::Input row-->
                <div class="d-flex">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input wire:model.defer="shippingAddress.default" class="form-check-input me-3 @error('shippingAddress.default') invalid-feedback @enderror" name="" type="checkbox" id="kt_shipping_address_default_option_{{ $user->id }}"/>
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_shipping_address_default_option_{{ $user->id }}">
                            <div class="fw-bolder text-gray-800">{{ __('Set as default') }}</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->
                @error('shippingAddress.default') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                <div class='separator separator-dashed my-5'></div>
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">{{ __('Full name') }}</span>
                </label>
                <input required wire:model.defer="shippingAddress.name" class="form-control form-control-solid @error('shippingAddress.name') invalid-feedback @enderror" placeholder="{{ __('Full name') }}" />
                @error('shippingAddress.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">{{ __('Phone') }}</span>
                </label>
                <input type="tel" required wire:model.defer="shippingAddress.phone" class="form-control form-control-solid @error('shippingAddress.phone') invalid-feedback @enderror" placeholder="Ejem: 33xxxxxxxx" />
                @error('shippingAddress.phone') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">{{ __('Email') }}</span>
                </label>
                <input required type="email" required wire:model.defer="shippingAddress.email" class="form-control form-control-solid @error('shippingAddress.email') invalid-feedback @enderror" placeholder="Correo electronico del cliente" />
                @error('shippingAddress.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('Country') }}</span>
                </label>
                <select wire:model="countryId" class="form-select form-select-solid @error('countryId') invalid-feedback @enderror">
                    <option value="">{{ __('Select a option') }}</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('countryId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">{{ __('State') }}</span>
                </label>
                <select wire:model.defer="shippingAddress.state_id" class="form-select form-select-solid @error('shippingAddress.state_id') invalid-feedback @enderror">
                    <option value="">{{ __('Select a option') }}</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('shippingAddress.state_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">{{ __('Municipality') }}</span>
                </label>
                <input required wire:model.defer="shippingAddress.municipality" class="form-control form-control-solid @error('shippingAddress.municipality') invalid-feedback @enderror" placeholder="Ejem: Guadalajara" />
                @error('shippingAddress.municipality') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">{{ __('Colony') }}</span>
                </label>
                <input required wire:model.defer="shippingAddress.colony" class="form-control form-control-solid @error('shippingAddress.colony') invalid-feedback @enderror" placeholder="" />
                @error('shippingAddress.colony') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">{{ __('Street') }}</span>
                </label>
                <input required wire:model.defer="shippingAddress.street" class="form-control form-control-solid @error('shippingAddress.street') invalid-feedback @enderror" placeholder="" />
                @error('shippingAddress.street') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="required">{{ __('Zip code') }}</span>
                </label>
                <input required wire:model.defer="shippingAddress.zip_code" type="number" minlength="5" class="form-control form-control-solid @error('shippingAddress.zip_code') invalid-feedback @enderror" placeholder="" />
                @error('shippingAddress.zip_code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="row">
                <div class="fv-row col-6 mb-7">
                    <label class="fs-6 fw-bolder form-label mb-2">
                        <span class="required">{{ __('Number ext') }}</span>
                    </label>
                    <input type="number" required wire:model.defer="shippingAddress.street_number_ext" class="form-control form-control-solid @error('shippingAddress.street_number_ext') invalid-feedback @enderror" placeholder="" />
                    @error('shippingAddress.street_number_ext') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <div class="fv-row col-6 mb-7">
                    <label class="fs-6 fw-bolder form-label mb-2">
                        <span class="">{{ __('Number int') }}</span>
                    </label>
                    <input type="number" wire:model.defer="shippingAddress.street_number_int" class="form-control form-control-solid @error('shippingAddress.street_number_int') invalid-feedback @enderror" placeholder="" />
                    @error('shippingAddress.street_number_int') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="">{{ __('Company name') }}</span>
                </label>
                <input wire:model.defer="shippingAddress.company" class="form-control form-control-solid @error('shippingAddress.company') invalid-feedback @enderror" placeholder="" />
                @error('shippingAddress.company') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bolder form-label mb-2">
                    <span class="">{{ __('Street references') }}</span>
                </label>
                <textarea wire:model.defer="shippingAddress.street_references" cols="30" rows="10" class="form-control form-control-solid @error('shippingAddress.street_references') invalid-feedback @enderror" placeholder="">{{ $shippingAddress->street_references }}</textarea>
                @error('shippingAddress.street_references') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
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
