<div class="mb-xl-8 mt-xl-8">
    <div class="border-0">
        <h3 class="card-title fw-bolder text-dark">{{ __('Shipping addresses') }}</h3>
        <hr>
    </div>
</div>
<!--begin::Content-->
@livewire('admin.user.shipping-address.index', ['user' => $user], key('user-shipping-address-'.$user->id))
<!--end::Card-->
