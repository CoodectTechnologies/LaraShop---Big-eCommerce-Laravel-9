@if ($shippingApplies)
    <h3 class="title billing-title text-uppercase ls-10 pt-5 pb-3 mb-0">
        {{ __('Shipping methods') }}
    </h3>
    @forelse ($shippingZones as $sz)
        <div class="form-group">
            <input wire:model="shippingZoneId" type="radio" class="custom-checkbox" id="shipping-method-{{ $sz['id'] }}" name="shipping-method" value="{{ $sz['id'] }}">
            <label for="shipping-method-{{ $sz['id'] }}">
                {{ $sz['name'] }} ${{ $sz['price'] }} ({{ $sz['days'].' '.__('days').' '.$sz['estimatedDate'] }})
            </label>
        </div>
    @empty
        <p>{{ __('There appear to be no shipping methods in your area.') }}</p>
    @endforelse
@endif


