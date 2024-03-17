<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12 col-12 mb-5">
            @include('admin.setting.access-payment.mercadopago.index')
        </div>
        <div class="col-lg-6 col-sm-12 col-12 mb-5">
            @include('admin.setting.access-payment.paypal.index')
        </div>
        <div class="col-lg-6 col-sm-12 col-12 mb-5">
            @include('admin.setting.access-payment.stripe.index')
        </div>
        <div class="col-lg-6 col-sm-12 col-12 mb-5">
            @include('admin.setting.access-payment.transfer.index')
        </div>
    </div>
    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
