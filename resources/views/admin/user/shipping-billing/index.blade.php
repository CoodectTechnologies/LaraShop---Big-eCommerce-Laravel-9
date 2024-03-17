<div class="mb-xl-8 mt-xl-8">
    <div class="border-0">
        <h3 class="card-title fw-bolder text-dark">{{ __('Billing addresses') }}</h3>
        <hr>
    </div>
</div>
@livewire('admin.user.shipping-billing.index', ['user' => $user], key('user-shipping-billing-' . $user->id))
<!--end::Card-->
