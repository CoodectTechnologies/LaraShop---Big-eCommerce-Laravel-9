@if(count($billingAddresses))
    <div class="form-group pt-3">
        <input wire:model="billingAddressRequire" type="checkbox" class="custom-checkbox" id="billing-address-require" name="billing-address-require">
        <label for="billing-address-require">{{ __('Select a billing address') }}</label>
        <span wire:target="billingAddressRequire" wire:loading.class="ml-4 load-more-overlay loading"></span>
    </div>
    <div class="" style="{{ $billingAddressRequire ? 'display: block' : 'display: none' }}">
        @error('billingAddressRequire') <p  class="form-text text-danger" role="alert">{{ $message }}</p> @enderror
        @foreach ($billingAddresses as $ba)
            <section class="btn-section btn-default-section">
                <h2 class="title mb-2">{{ $ba->name }} ({{ $ba->vat }})</h2>
                <div class="row">
                    <div class="col-lg-7 col">
                        <p class="text-left">
                            <strong>{{ __('Country') }}</strong> : {{ $ba->state->country->name }},
                            <strong>{{ __('State') }}</strong> : {{ $ba->state->name }},
                            <strong>{{ __('Municipality') }}</strong> : {{ $ba->municipality }},
                            <strong>{{ __('Colony') }}</strong>: {{ $ba->colony }},
                            <strong>{{ __('Street') }}</strong> : {{ $ba->street }}
                            <strong>{{ __('Zip code') }}</strong> : {{ $ba->zip_code }},
                            <strong>{{ __('Phone') }}</strong> : {{ $ba->phone }},
                            <strong>{{ __('Email') }}</strong> : {{ $ba->email }},
                        </p>
                    </div>
                    <div class="col-lg-3 col">
                        <div class="btn-group">
                            <div class="btn-wrap">
                                @if($billingAddress && ($billingAddress->id == $ba->id))
                                    <a wire:click.prevent="loadBillingAddress({{ $ba->id }})" class="btn btn-primary">{{ __('Selected') }}</a>
                                @else:
                                    <a wire:click.prevent="loadBillingAddress({{ $ba->id }})" href="#" class="btn btn-primary btn-outline">{{ __('Billing here') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    </div>
@endif
