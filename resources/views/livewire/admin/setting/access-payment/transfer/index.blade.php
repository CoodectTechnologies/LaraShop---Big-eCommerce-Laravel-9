<div>
    <div class="card card-access-payments shadow bg-body rounded">
        <div class="card-header align-items-center border-0 mt-4">
            <h3 class="card-title align-items-start flex-column">
                <img width="80" src="{{ asset('assets/admin/media/method_payment/transfer.png') }}" alt="Transfer">
            </h3>
            <div class="card-toolbar">
                @include('admin.setting.access-payment.transfer.edit')
            </div>
        </div>
        <div class="card-body">
            <div class="mb-5">
                <p class="fw-bolder text-dark mb-0">{{ __('Status') }}</p>
                <div class="fw-bold text-gray-700">
                    @if (config('services.transfer.status'))
                        <span class="badge badge-primary">{{ __('Active') }}</span>
                    @else
                        <span class="badge badge-secondary">{{ __('Off') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-5">
                <p class="fw-bolder text-dark mb-0">{{ __('To name') }}</p>
                <div class="fw-bold text-gray-700">
                    {{ config('services.transfer.name') }}
                </div>
            </div>
            <div class="mb-5">
                <p class="fw-bolder text-dark mb-0">{{ __('Bank account') }}</p>
                <div class="fw-bold text-gray-700">
                    {{ config('services.transfer.account_bank') }}
                </div>
            </div>
        </div>
    </div>
</div>
