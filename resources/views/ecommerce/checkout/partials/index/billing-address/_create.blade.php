@if (!count($billingAddresses))
    <div class="form-group pt-5">
        <input wire:model="billingAddressCreate" type="checkbox" class="custom-checkbox" id="billing-address-create" name="billing-address-create">
        <label for="billing-address-create">{{ __('Do you need billing address?') }}</label>
        <span wire:target="billingAddressCreate" wire:loading.class="ml-4 load-more-overlay loading"></span>
    </div>
    <div class="" style="{{ $billingAddressCreate ? 'display: block' : 'display: none' }}">
        <button
            wire:click="replicateShippingAddressToBillingAddress"
            wire:loading.class="ml-4 load-more-overlay loading"
            wire:target="replicateShippingAddressToBillingAddress"
            type="button"
            class="btn btn-primary">
            {{ __('Same address as shipping address') }}
        </button>
        <div class="row gutter-sm">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('Full name') }} *</label>
                    <input wire:model.defer="billingAddress.name" name="billing_name" type="text" class="form-control form-control-md @error('billingAddress.name') invalid-feedback @enderror" required>
                    @error('billingAddress.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('Email') }} *</label>
                    <input wire:model.defer="billingAddress.email" name="billing_email" type="email" class="form-control form-control-md @error('billingAddress.email') invalid-feedback @enderror" required>
                    @error('billingAddress.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Phone') }} *</label>
            <input wire:model.defer="billingAddress.phone" name="billing_phone" type="text" class="form-control form-control-md @error('billingAddress.phone') invalid-feedback @enderror" required>
            @error('billingAddress.phone') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Company name') }} ({{ __('optional') }})</label>
            <input wire:model.defer="billingAddress.company" name="billing_company" type="text" class="form-control form-control-md @error('billingAddress.company') invalid-feedback @enderror">
            @error('billingAddress.company') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label>{{ __('EIN') }}</label>
            <input wire:model.defer="billingAddress.vat" minlength="12" maxlength="13" name="billing_vat" type="text" class="form-control form-control-md @error('billingAddress.vat') invalid-feedback @enderror">
            @error('billingAddress.vat') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <div class="row gutter-sm">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('Zip code') }} *</label>
                    <input wire:model.defer="billingAddress.zip_code" name="billing_zip_code" type="number" class="form-control form-control-md @error('billingAddress.zip_code') invalid-feedback @enderror" required>
                    @error('billingAddress.zip_code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('Country') }} *</label>
                    <div class="select-box">
                        <select wire:model="billingAddressCountryId" name="billing_country_id" wire:change="loadBillingAddressStates($event.target.value)" class="form-control form-control-md @error('billingAddressCountryId') invalid-feedback @enderror" required>
                            <option value="">{{ __('Select a country') }}</option>
                            @foreach ($billingAddressCountries as $billingAddressCountry)
                                <option value="{{ $billingAddressCountry->id }}">{{ $billingAddressCountry->name }}</option>
                            @endforeach
                        </select>
                        @error('billingAddressCountryId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row gutter-sm">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('State') }} *</label>
                    <div class="select-box">
                        <select wire:model="billingAddress.state_id" name="billing_state_id" class="form-control form-control-md @error('billingAddress.state_id') invalid-feedback @enderror" required>
                            <option value="">{{ __('Select a state') }}</option>
                            @foreach ($billingAddressStates as $billingAddressState)
                                <option value="{{ $billingAddressState->id }}">{{ $billingAddressState->name }}</option>
                            @endforeach
                        </select>
                        @error('billingAddress.state_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('Municipality') }} *</label>
                    <input wire:model.defer="billingAddress.municipality" name="billing_municipality" type="text" class="form-control form-control-md @error('billingAddress.municipality') invalid-feedback @enderror" required>
                    @error('billingAddress.municipality') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Colony') }} *</label>
            <input wire:model.defer="billingAddress.colony" name="billing_colony" type="text" class="form-control form-control-md @error('billingAddress.colony') invalid-feedback @enderror" required>
            @error('billingAddress.colony') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <div class="row ">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Number ext') }} *</label>
                    <input wire:model.defer="billingAddress.street_number_ext" name="billing_street_number_ext" type="number" class="form-control form-control-md @error('billingAddress.street_number_ext') invalid-feedback @enderror" required>
                    @error('billingAddress.street_number_ext') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('Number int') }} ({{ __('optional') }})</label>
                    <input wire:model.defer="billingAddress.street_number_int" name="billing_street_number_int" type="number" class="form-control form-control-md @error('billingAddress.street_number_int') invalid-feedback @enderror">
                    @error('billingAddress.street_number_int') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Street address') }} *</label>
            <input wire:model.defer="billingAddress.street" name="billing_street" type="text" class="form-control form-control-md @error('billingAddress.street') invalid-feedback @enderror" required>
            @error('billingAddress.street') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Between streets') }} ({{ __('optional') }})</label>
            <input wire:model.defer="billingAddress.street_between" name="billing_street_between" type="text" class="form-control form-control-md @error('billingAddress.street_between') invalid-feedback @enderror">
            @error('billingAddress.street_between') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <div class="form-group mt-3">
            <label>{{ __('Street references') }} ({{ __('optional') }})</label>
            <textarea wire:model.defer="billingAddress.street_references" name="billing_street_references" class="form-control mb-0 @error('billingAddress.street_references') invalid-feedback @enderror" name="order-notes" cols="30" rows="4" placeholder="{{ __('Notes about your order, e.g special notes for delivery') }}"></textarea>
        </div>
    </div>
@endif
