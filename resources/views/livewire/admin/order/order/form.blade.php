<div>
    @include('admin.components.errors')
    <form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row">
        <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
            @include('admin.order.order.partials.form._detail')
        </div>
        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-3">
            @include('admin.order.order.partials.form._product')
            @include('admin.order.order.partials.form._coupon')
            @include('admin.order.order.partials.form._address')
            @include('admin.order.order.partials.form._shipping-method')
            @include('admin.order.order.partials.form._summary')
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.order.index') }}" class="btn btn-light me-5">{{ __('Cancel') }}</a>
                <button
                    wire:loading.attr="disabled"
                    wire:target="{{ $method }}"
                    type="submit"
                    class="btn btn-primary"
                    {{ ($shippingApplies && !count($shippingZones)) ? 'disabled' : '' }}
                    {{ ($shippingApplies && !$shippingZoneId) ? 'disabled' : '' }}
                    {{ !count($shippingAddress) ? 'disabled' : '' }}
                    {{ !Cart::instance('default')->count() ? 'disabled' : '' }}>
                    <span class="indicator-label">{{ __('Save changes') }}</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
            </div>
        </div>
    </form>
    @include('admin.order.order.partials.form._billing-address')
    @include('admin.order.order.partials.form._shipping-address')
    @push('footer')
        <script>
            $('.userId').select2({
                allowClear: true
            }).on('change', function (e) {
                @this.set('userId', $(this).select2("val"));
            });
            Livewire.on('closeModal', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
