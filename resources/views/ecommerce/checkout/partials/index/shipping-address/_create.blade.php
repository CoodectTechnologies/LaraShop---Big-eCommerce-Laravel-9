@if (!count($shippingAddresses))
<div class="row gutter-sm">
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('Full name') }} *</label>
            <input wire:model.defer="shippingAddress.name" name="name" required type="text" class="form-control form-control-md @error('shippingAddress.name') invalid-feedback @enderror"/>
            @error('shippingAddress.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('Email') }} *</label>
            <input wire:model.defer="shippingAddress.email" name="email" required type="email" class="form-control form-control-md @error('shippingAddress.email') invalid-feedback @enderror"/>
            @error('shippingAddress.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <label>{{ __('Phone') }} *</label>
    <input wire:model.defer="shippingAddress.phone" name="phone" required type="text" class="form-control form-control-md @error('shippingAddress.phone') invalid-feedback @enderror"/>
    @error('shippingAddress.phone') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
</div>
<div class="form-group">
    <label>{{ __('Company name') }} ({{ __('optional') }})</label>
    <input wire:model.defer="shippingAddress.company" name="company" type="text" class="form-control form-control-md @error('shippingAddress.company') invalid-feedback @enderror">
    @error('shippingAddress.company') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
</div>
<div class="row gutter-sm">
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('Zip code') }} *</label>
            <input wire:model.defer="shippingAddress.zip_code" wire:change="changeZipCode()" name="zip_code" required type="number" class="form-control form-control-md @error('shippingAddress.zip_code') invalid-feedback @enderror"/>
            @error('shippingAddress.zip_code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('Country') }} *</label>
            <div class="select-box">
                <select wire:model="shippingAddressCountryId" wire:change="loadShippingAddressStates($event.target.value)" name="shippingAddressCountryId" required class="form-control form-control-md @error('shippingAddressCountryId') invalid-feedback @enderror">
                    <option value="">{{ __('Select a country') }}</option>
                    @foreach ($shippingAddressCountries as $shippingAddressCountry)
                        <option value="{{ $shippingAddressCountry->id }}">{{ $shippingAddressCountry->name }}</option>
                    @endforeach
                </select>
                @error('shippingAddressCountryId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
        </div>
    </div>
</div>
<div class="row gutter-sm">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('State') }} *</label>
            <div class="select-box">
                <select wire:model="shippingAddress.state_id" name="state_id" wire:change="changeZipCode()" required class="form-control form-control-md @error('shippingAddress.state_id') invalid-feedback @enderror">
                    <option value="">{{ __('Select a state') }}</option>
                    @foreach ($shippingAddressStates as $shippingAddressState)
                        <option value="{{ $shippingAddressState->id }}">{{ $shippingAddressState->name }}</option>
                    @endforeach
                </select>
                @error('shippingAddress.state_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{ __('Municipality') }} *</label>
            <input wire:model.defer="shippingAddress.municipality" name="municipality" required type="text" class="form-control form-control-md @error('shippingAddress.municipality') invalid-feedback @enderror"/>
            @error('shippingAddress.municipality') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <label>{{ __('Colony') }} *</label>
    <input wire:model.defer="shippingAddress.colony" required name="colony" type="text" class="form-control form-control-md @error('shippingAddress.colony') invalid-feedback @enderror"/>
    @error('shippingAddress.colony') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
</div>
<div class="row ">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Number ext') }} *</label>
            <input wire:model.defer="shippingAddress.street_number_ext" required name="street_number_ext" type="number" class="form-control form-control-md @error('shippingAddress.street_number_ext') invalid-feedback @enderror"/>
            @error('shippingAddress.street_number_ext') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('Number int') }} ({{ __('optional') }})</label>
            <input wire:model.defer="shippingAddress.street_number_int" name="street_number_int" type="number" class="form-control form-control-md @error('shippingAddress.street_number_int') invalid-feedback @enderror">
            @error('shippingAddress.street_number_int') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <label>{{ __('Street address') }} *</label>
    <input wire:model.defer="shippingAddress.street" required name="street" type="text" class="form-control form-control-md @error('shippingAddress.street') invalid-feedback @enderror">
    @error('shippingAddress.street') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
</div>
<div class="form-group">
    <label>{{ __('Between streets') }} ({{ __('optional') }})</label>
    <input wire:model.defer="shippingAddress.street_between" type="text" class="form-control form-control-md @error('shippingAddress.street_between') invalid-feedback @enderror">
    @error('shippingAddress.street_between') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
</div>
<div class="form-group mt-3">
    <label>{{ __('Street references') }} ({{ __('optional') }})</label>
    <textarea wire:model.defer="shippingAddress.street_references" name="street_references" class="form-control mb-0 @error('shippingAddress.street_references') invalid-feedback @enderror" name="order-notes" cols="30" rows="4" placeholder="{{ __('Notes about your order, e.g special notes for delivery') }}"></textarea>
</div>
@endif
