@auth
    @if (count($shippingAddresses))
        <div class="form-group">
            <input wire:model="shippingAddressDiferentCreate" type="checkbox" class="custom-checkbox" id="shipping-address-create-diferent" name="shipping-address-create-diferent">
            <label for="shipping-address-create-diferent">{{ __('Shipping address different?') }}</label>
            <span wire:target="shippingAddressDiferentCreate" wire:loading.class="ml-4 load-more-overlay loading"></span>
        </div>
        <div class="" style="{{ $shippingAddressDiferentCreate ? 'display: block' : 'display: none' }}">
            <div class="row gutter-sm">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Full name') }} *</label>
                        <input wire:model.defer="shippingAddressDiferent.name" name="name" required type="text" class="form-control form-control-md @error('shippingAddressDiferent.name') invalid-feedback @enderror"/>
                        @error('shippingAddressDiferent.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Email') }} *</label>
                        <input wire:model.defer="shippingAddressDiferent.email" name="email" required type="email" class="form-control form-control-md @error('shippingAddressDiferent.email') invalid-feedback @enderror"/>
                        @error('shippingAddressDiferent.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Phone') }} *</label>
                <input wire:model.defer="shippingAddressDiferent.phone" name="phone" required type="text" class="form-control form-control-md @error('shippingAddressDiferent.phone') invalid-feedback @enderror"/>
                @error('shippingAddressDiferent.phone') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Company name') }} ({{ __('optional') }})</label>
                <input wire:model.defer="shippingAddressDiferent.company" name="company" type="text" class="form-control form-control-md @error('shippingAddressDiferent.company') invalid-feedback @enderror">
                @error('shippingAddressDiferent.company') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="row gutter-sm">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Zip code') }} *</label>
                        <input wire:model.defer="shippingAddressDiferent.zip_code" wire:keydown="changeZipCode()" name="zip_code" required type="number" class="form-control form-control-md @error('shippingAddressDiferent.zip_code') invalid-feedback @enderror"/>
                        @error('shippingAddressDiferent.zip_code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Country') }} *</label>
                        <div class="select-box">
                            <select wire:model="shippingAddressDiferentCountryId" wire:change="loadShippingAddressDiferentStates($event.target.value)" name="shippingAddressDiferentCountryId" required class="form-control form-control-md @error('shippingAddressDiferentCountryId') invalid-feedback @enderror">
                                <option value="">{{ __('Select a country') }}</option>
                                @foreach ($shippingAddressDiferentCountries as $shippingAddressDiferentCountry)
                                    <option value="{{ $shippingAddressDiferentCountry->id }}">{{ $shippingAddressDiferentCountry->name }}</option>
                                @endforeach
                            </select>
                            @error('shippingAddressDiferentCountryId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutter-sm">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('State') }} *</label>
                        <div class="select-box">
                            <select wire:model="shippingAddressDiferent.state_id" wire:change="changeZipCode()" name="state_id" required class="form-control form-control-md @error('shippingAddressDiferent.state_id') invalid-feedback @enderror">
                                <option value="">{{ __('Select a state') }}</option>
                                @foreach ($shippingAddressDiferentStates as $shippingAddressDiferentState)
                                    <option value="{{ $shippingAddressDiferentState->id }}">{{ $shippingAddressDiferentState->name }}</option>
                                @endforeach
                            </select>
                            @error('shippingAddressDiferent.state_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('Municipality') }} *</label>
                        <input wire:model.defer="shippingAddressDiferent.municipality" name="municipality" required type="text" class="form-control form-control-md @error('shippingAddressDiferent.municipality') invalid-feedback @enderror"/>
                        @error('shippingAddressDiferent.municipality') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Colony') }} *</label>
                <input wire:model.defer="shippingAddressDiferent.colony" required name="colony" type="text" class="form-control form-control-md @error('shippingAddressDiferent.colony') invalid-feedback @enderror"/>
                @error('shippingAddressDiferent.colony') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="row ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Number ext') }} *</label>
                        <input wire:model.defer="shippingAddressDiferent.street_number_ext" required name="street_number_ext" type="number" class="form-control form-control-md @error('shippingAddressDiferent.street_number_ext') invalid-feedback @enderror"/>
                        @error('shippingAddressDiferent.street_number_ext') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('Number int') }} ({{ __('optional') }})</label>
                        <input wire:model.defer="shippingAddressDiferent.street_number_int" name="street_number_int" type="number" class="form-control form-control-md @error('shippingAddressDiferent.street_number_int') invalid-feedback @enderror">
                        @error('shippingAddressDiferent.street_number_int') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ __('Street address') }} *</label>
                <input wire:model.defer="shippingAddressDiferent.street" required name="street" type="text" class="form-control form-control-md @error('shippingAddressDiferent.street') invalid-feedback @enderror">
                @error('shippingAddressDiferent.street') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>{{ __('Between streets') }} ({{ __('optional') }})</label>
                <input wire:model.defer="shippingAddressDiferent.street_between" type="text" class="form-control form-control-md @error('shippingAddressDiferent.street_between') invalid-feedback @enderror">
                @error('shippingAddressDiferent.street_between') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <div class="form-group mt-3">
                <label>{{ __('Street references') }} ({{ __('optional') }})</label>
                <textarea wire:model.defer="shippingAddressDiferent.street_references" name="street_references" class="form-control mb-0 @error('shippingAddressDiferent.street_references') invalid-feedback @enderror" name="order-notes" cols="30" rows="4" placeholder="{{ __('Notes about your order, e.g special notes for delivery') }}"></textarea>
            </div>
        </div>
    @endif
@endauth
