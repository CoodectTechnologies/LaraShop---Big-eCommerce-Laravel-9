@if (count($shippingAddresses))
    @error('shippingAddressRequire') <p  class="form-text text-danger" role="alert">{{ $message }}</p> @enderror
    @foreach ($shippingAddresses as $sa)
        <section class="btn-section btn-default-section mb-2 mt-3">
            <h2 class="title mb-2">{{ $sa->name }} ({{ $sa->zip_code }})</h2>
            <div class="row">
                <div class="col-lg-7 col">
                    <p class="text-left">
                        <strong>{{ __('Country') }}</strong> : {{ $sa->state->country->name }}
                        <strong>{{ __('State') }}</strong> : {{ $sa->state->name }}
                        <strong>{{ __('Municipality') }}</strong> : {{ $sa->municipality }}
                        <strong>{{ __('Colony') }}</strong>: {{ $sa->colony }}
                        <strong>{{ __('Street') }}</strong> : {{ $sa->street }},
                        <strong>{{ __('Zip code') }}</strong> : {{ $sa->zip_code }},
                        <strong>{{ __('Phone') }}</strong> : {{ $sa->phone }},
                        <strong>{{ __('Email') }}</strong> : {{ $sa->email }},
                    </p>
                </div>
                <div class="col-lg-3 col">
                    <div class="btn-group">
                        <div class="btn-wrap">
                            @if($shippingAddress && ($shippingAddress->id == $sa->id))
                                <a wire:click.prevent="loadShippingAddress({{ $sa->id }})" class="btn btn-primary active">{{ __('Selected') }}</a>
                            @else:
                                <a wire:click.prevent="loadShippingAddress({{ $sa->id }})" href="#" class="btn btn-primary btn-outline">{{ __('Ship here') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endif
