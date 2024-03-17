<div>
    <!-- Start of PageContent -->
    <div class="page-content pt-2">
        <div class="container">
            <div class="tab tab-vertical row gutter-lg">

                @include('ecommerce.account.menu.index')

                <div class="tab-content mb-6">
                    <div class="tab-pane active in" id="account-addresses">
                        <div class="row mb-5">
                            <h4 class="title title-underline ls-25 font-weight-bold">
                                {{ __('Billing addresses') }}
                            </h4>
                        </div>
                        <div class="ecommerce-address shipping-address pr-lg-8">
                            <form wire:submit.prevent="{{ $method }}">
                                @include('ecommerce.components.alert')
                                <div class="row gutter-sm">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Full name') }} *</label>
                                            <input wire:model.defer="billingAddress.name" name="name" required type="text" class="form-control form-control-md @error('billingAddress.name') invalid-feedback @enderror"/>
                                            @error('billingAddress.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Email') }} *</label>
                                            <input wire:model.defer="billingAddress.email" name="email" required type="email" class="form-control form-control-md @error('billingAddress.email') invalid-feedback @enderror"/>
                                            @error('billingAddress.email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Phone') }} *</label>
                                    <input wire:model.defer="billingAddress.phone" name="phone" required type="text" class="form-control form-control-md @error('billingAddress.phone') invalid-feedback @enderror"/>
                                    @error('billingAddress.phone') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Company name') }} ({{ __('optional') }})</label>
                                    <input wire:model.defer="billingAddress.company" name="company" type="text" class="form-control form-control-md @error('billingAddress.company') invalid-feedback @enderror">
                                    @error('billingAddress.company') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('EIN') }} ({{ __('optional') }})</label>
                                    <input wire:model.defer="billingAddress.vat" minlength="12" maxlength="13" name="vat" type="text" class="form-control form-control-md @error('billingAddress.vat') invalid-feedback @enderror">
                                    @error('billingAddress.vat') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Zip code') }} *</label>
                                            <input wire:model.defer="billingAddress.zip_code" name="zip_code" required type="number" class="form-control form-control-md @error('billingAddress.zip_code') invalid-feedback @enderror"/>
                                            @error('billingAddress.zip_code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Country') }} *</label>
                                            <div class="select-box">
                                                <select wire:model="countryId" wire:change="loadStates($event.target.value)" name="countryId" required class="form-control form-control-md @error('countryId') invalid-feedback @enderror">
                                                    <option value="">{{ __('Select a country') }}</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('countryId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('State') }} *</label>
                                            <div class="select-box">
                                                <select wire:model="billingAddress.state_id" name="state_id" required class="form-control form-control-md @error('billingAddress.state_id') invalid-feedback @enderror">
                                                    <option value="">{{ __('Select a state') }}</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('billingAddress.state_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{ __('Municipality') }} *</label>
                                            <input wire:model.defer="billingAddress.municipality" name="municipality" required type="text" class="form-control form-control-md @error('billingAddress.municipality') invalid-feedback @enderror"/>
                                            @error('billingAddress.municipality') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Colony') }} *</label>
                                    <input wire:model.defer="billingAddress.colony" required name="colony" type="text" class="form-control form-control-md @error('billingAddress.colony') invalid-feedback @enderror"/>
                                    @error('billingAddress.colony') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Number ext') }} *</label>
                                            <input wire:model.defer="billingAddress.street_number_ext" required name="street_number_ext" type="number" class="form-control form-control-md @error('billingAddress.street_number_ext') invalid-feedback @enderror"/>
                                            @error('billingAddress.street_number_ext') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Number int') }} ({{ __('optional') }})</label>
                                            <input wire:model.defer="billingAddress.street_number_int" name="street_number_int" type="number" class="form-control form-control-md @error('billingAddress.street_number_int') invalid-feedback @enderror">
                                            @error('billingAddress.street_number_int') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Street address') }} *</label>
                                    <input wire:model.defer="billingAddress.street" required name="street" type="text" class="form-control form-control-md @error('billingAddress.street') invalid-feedback @enderror">
                                    @error('billingAddress.street') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Between streets') }} ({{ __('optional') }})</label>
                                    <input wire:model.defer="billingAddress.street_between" type="text" class="form-control form-control-md @error('billingAddress.street_between') invalid-feedback @enderror">
                                    @error('billingAddress.street_between') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label>{{ __('Street references') }} ({{ __('optional') }})</label>
                                    <textarea wire:model.defer="billingAddress.street_references" name="street_references" class="form-control mb-0 @error('billingAddress.street_references') invalid-feedback @enderror" name="order-notes" cols="30" rows="4" placeholder="{{ __('Notes about your order, e.g special notes for delivery') }}"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Default') }} *</label>
                                    <div class="select-box">
                                        <select wire:model="billingAddress.default" name="default" required class="form-control form-control-md @error('billingAddress.default') invalid-feedback @enderror">
                                            <option value="">{{ __('Is default') }}</option>
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0">{{ __('No') }}</option>
                                        </select>
                                        @error('billingAddress.default') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <button
                                    wire:target.prevent="{{ $method }}"
                                    wire:loading.class="load-more-overlay loading"
                                    wire:loading.disabled
                                    type="submit"
                                    class="btn btn-dark btn-rounded">
                                    {{ __('Save changes') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</div>
