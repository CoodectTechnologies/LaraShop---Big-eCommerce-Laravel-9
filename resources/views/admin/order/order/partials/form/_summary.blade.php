<div class="row">
    <div class="col-lg-6">
    </div>
    <div class="col-lg-6">
        <div class="table-responsive mb-10">
            <table class="table g-5 gs-0 mb-0 fw-bolder text-gray-700" data-kt-element="items">
                <tfoot>
                    <tr class="border-top border-top-dashed align-top fs-6 fw-bolder text-gray-700">
                        <th class="text-primary"></th>
                        <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                            <div class="d-flex flex-column align-items-start">
                                <div class="fs-5">{{ __('Subtotal') }}</div>
                            </div>
                        </th>
                        <th colspan="2" class="border-bottom border-bottom-dashed text-end">
                            @if ($subtotal)
                                $ <span data-kt-element="sub-total">{{ number_format($subtotal, 2) }} {{ session()->get('currency') }}</span>
                            @else
                                <span data-kt-element="sub-total">{{ __('On hold') }}</span>
                            @endif
                        </th>
                    </tr>
                    @if($coupon)
                        <tr class="border-top border-top-dashed align-top fs-6 fw-bolder text-gray-700">
                            <th class="text-primary"></th>
                            <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                                <div class="d-flex flex-column align-items-start">
                                    <div class="fs-5">{{ __('Coupon') }}</div>
                                </div>
                            </th>
                            <th colspan="2" class="border-bottom border-bottom-dashed text-end"><span data-kt-element="sub-total">- ${{ number_format($couponPriceDiscount, 2) }} {{ session()->get('currency') }} ({{ $coupon->percentage }})%</span></th>
                        </tr>
                    @endif
                    <tr class="border-top border-top-dashed align-top fs-6 fw-bolder text-gray-700">
                        <th class="text-primary"></th>
                        <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                            <div class="d-flex flex-column align-items-start">
                                <div class="fs-5">{{ __('Shipping price') }}</div>
                            </div>
                        </th>
                        @if ($shippingApplies && (count($shippingZones) && !$shippingZoneId) || (!count($shippingZones)))
                            <th colspan="2" class="border-bottom border-bottom-dashed text-end"><span data-kt-element="sub-total">{{ __('On hold') }}</span></th>
                        @else
                            <th colspan="2" class="border-bottom border-bottom-dashed text-end">$ <span data-kt-element="sub-total">{{ number_format($this->shippingPrice, 2) }} {{ session()->get('currency') }}</span></th>
                        @endif
                    </tr>
                    <tr class="align-top fw-bolder text-gray-700">
                        <th></th>
                        <th colspan="2" class="fs-4 ps-0">Total</th>
                        <th colspan="2" class="text-end fs-4 text-nowrap">
                            @if (
                                ($shippingApplies && count($shippingZones) && !$shippingZoneId) ||
                                ($shippingApplies && !count($shippingZones))
                            )
                                <span data-kt-element="grand-total">{{ __('On hold') }}</span>
                            @else
                                $<span data-kt-element="grand-total">{{ number_format($this->total, 2) }} {{ session()->get('currency') }}</span>
                            @endif
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
