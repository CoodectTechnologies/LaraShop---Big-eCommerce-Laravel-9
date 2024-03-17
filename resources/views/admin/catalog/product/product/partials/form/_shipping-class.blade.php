<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('Shipping classes') }}</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Shipping form-->
        <div class="mt-10">
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="form-label">{{ __('Shipping class') }}</label>
                <!--end::Label-->
                <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-info me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"></rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"></rect>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                            {{ __('Shipping classes are used to group products; are not used directly to offer shipping rates to customers') }}
                        </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--begin::Editor-->
                <select wire:model.defer="product.shipping_class_id" class="form-control mb-2 @error('product.shipping_class_id') invalid-feedback @enderror" placeholder="Ejem: 2">
                    <option value="">{{ __('Select a option') }}</option>
                    @foreach ($shippingClasses as $shippingClass)
                        <option value="{{ $shippingClass->id }}">{{ $shippingClass->name }}</option>
                    @endforeach
                </select>
                <!--end::Editor-->
                @error('product.shipping_class_id')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Description-->
                <div class="text-muted fs-7">{{ __('You can set a shipping class') }}</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Shipping form-->
    </div>
    <!--end::Card header-->
    <!--begin::Card header-->
</div>
