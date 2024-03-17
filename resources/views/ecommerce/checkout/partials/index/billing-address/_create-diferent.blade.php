@auth
    @if (count($billingAddresses))
        <div class="form-group">
            <input wire:model="billingAddressDiferentCreate" type="checkbox" class="custom-checkbox" id="billing-address-create-diferent" name="billing-address-create-diferent">
            <label for="billing-address-create-diferent">{{ __('Billing address different?') }}</label>
            <span wire:target="billingAddressDiferentCreate" wire:loading.class="ml-4 load-more-overlay loading"></span>
        </div>
        <div class="" style="{{ $billingAddressDiferentCreate ? 'display: block' : 'display: none' }}">
            <div class="row gutter-sm">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Full name') }} *</label>
                        <input wire:model.defer="billingAddressDiferent.name" name="billing_name" type="text" class="form-control form-control-md @error('billingAddressDiferent.name') invalid-feedback @enderror" required>
                        @error('billingAddressDiferent.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Email') }} *</label>
                        <input wire:model.defer="billingAddressDiferent.email" name="billing_email" type="email" class="form-control form-control-md @error('billingAddressDiferent.email') invalid-feedback @enderror" required>
                        @error('billingAddressDiferent.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Phone') }} *</label>
                <input wire:model.defer="billingAddressDiferent.phone" name="billing_phone" type="text" class="form-control form-control-md @error('billingAddressDiferent.phone') invalid-feedback @enderror" required>
                @error('billingAddressDiferent.phone') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Company name') }} ({{ __('optional') }})</label>
                <input wire:model.defer="billingAddressDiferent.company" name="billing_company" type="text" class="form-control form-control-md @error('billingAddressDiferent.company') invalid-feedback @enderror">
                @error('billingAddressDiferent.company') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>{{ __('EIN') }}</label>
                <input wire:model.defer="billingAddressDiferent.vat" minlength="12" maxlength="13" name="billing_vat" type="text" class="form-control form-control-md @error('billingAddressDiferent.vat') invalid-feedback @enderror">
                @error('billingAddressDiferent.vat') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="row gutter-sm">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Zip code') }} *</label>
                        <input wire:model.defer="billingAddressDiferent.zip_code" name="billing_zip_code" type="number" class="form-control form-control-md @error('billingAddressDiferent.zip_code') invalid-feedback @enderror" required>
                        @error('billingAddressDiferent.zip_code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Country') }} *</label>
                        <div class="select-box">
                            <select wire:model="billingAddressDiferentCountryId" name="billing_country_id" wire:change="loadBillingAddressDiferentStates($event.target.value)" class="form-control form-control-md @error('billingAddressDiferentCountryId') invalid-feedback @enderror" required>
                                <option value="">{{ __('Select a country') }}</option>
                                @foreach ($billingAddressDiferentCountries as $billingAddressDiferentCountry)
                                    <option value="{{ $billingAddressDiferentCountry->id }}">{{ $billingAddressDiferentCountry->name }}</option>
                                @endforeach
                            </select>
                            @error('billingAddressDiferentCountryId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutter-sm">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('State') }} *</label>
                        <div class="select-box">
                            <select wire:model="billingAddressDiferent.state_id" name="billing_state_id" class="form-control form-control-md @error('billingAddressDiferent.state_id') invalid-feedback @enderror" required>
                                <option value="">{{ __('Select a state') }}</option>
                                @foreach ($billingAddressDiferentStates as $billingAddressDiferentState)
                                    <option value="{{ $billingAddressDiferentState->id }}">{{ $billingAddressDiferentState->name }}</option>
                                @endforeach
                            </select>
                            @error('billingAddressDiferent.state_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Municipality') }} *</label>
                        <input wire:model.defer="billingAddressDiferent.municipality" name="billing_municipality" type="text" class="form-control form-control-md @error('billingAddressDiferent.municipality') invalid-feedback @enderror" required>
                        @error('billingAddressDiferent.municipality') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Colony') }} *</label>
                <input wire:model.defer="billingAddressDiferent.colony" name="billing_colony" type="text" class="form-control form-control-md @error('billingAddressDiferent.colony') invalid-feedback @enderror" required>
                @error('billingAddressDiferent.colony') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Number ext') }} *</label>
                        <input wire:model.defer="billingAddressDiferent.street_number_ext" name="billing_street_number_ext" type="number" class="form-control form-control-md @error('billingAddressDiferent.street_number_ext') invalid-feedback @enderror" required>
                        @error('billingAddressDiferent.street_number_ext') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Number int') }} ({{ __('optional') }})</label>
                        <input wire:model.defer="billingAddressDiferent.street_number_int" name="billing_street_number_int" type="number" class="form-control form-control-md @error('billingAddressDiferent.street_number_int') invalid-feedback @enderror">
                        @error('billingAddressDiferent.street_number_int') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Street address') }} *</label>
                <input wire:model.defer="billingAddressDiferent.street" name="billing_street" type="text" class="form-control form-control-md @error('billingAddressDiferent.street') invalid-feedback @enderror" required>
                @error('billingAddressDiferent.street') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Between streets') }} ({{ __('optional') }})</label>
                <input wire:model.defer="billingAddressDiferent.street_between" name="billing_street_between" type="text" class="form-control form-control-md @error('billingAddressDiferent.street_between') invalid-feedback @enderror">
                @error('billingAddressDiferent.street_between') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label>{{ __('Street references') }} ({{ __('optional') }})</label>
                <textarea wire:model.defer="billingAddressDiferent.street_references" name="billing_street_references" class="form-control mb-0 @error('billingAddressDiferent.street_references') invalid-feedback @enderror" name="order-notes" cols="30" rows="4" placeholder="{{ __('Notes about your order, e.g special notes for delivery') }}"></textarea>
            </div>
        </div>
    @endif
@endauth
