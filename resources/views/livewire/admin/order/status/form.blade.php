<div>
    <div class="my-4">
        <form class="form" wire:submit.prevent="update">
            <!--begin::Order data-->
            <div class="card card-flush flex-row-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Payment status') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select wire:model.defer="order.payment_status" class="form-select mb-2 @error('order.payment_status') invalid-feedback @enderror">
                                @foreach ($this->paymentStatuses() as $paymentStatus)
                                    <option value="{{ $paymentStatus }}">{{ __($paymentStatus) }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            @error('order.payment_status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Card body-->
                    </div>
                    <div class="col-lg-6">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Status') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select2-->
                            <select wire:model.defer="order.status" class="form-select mb-2 @error('order.status') invalid-feedback @enderror">
                                @foreach ($this->statuses() as $status)
                                    <option value="{{ $status }}">{{ __($status) }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                            @error('order.status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <div class="container">
                    <!--end:: Save changes-->
                    <div class="d-flex justify-content-end mb-5">
                        <!--begin::Button-->
                        <button wire:loading.attr="disabled" wire:target="update" type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('Update') }}</span>
                            <span wire:loading wire:target="update" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end:: Save changes-->
                </div>
            </div>
            <!--end::Order data-->
        </form>
    </div>
</div>
