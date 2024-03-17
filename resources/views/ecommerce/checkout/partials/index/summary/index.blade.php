<div>
    <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 pt-5 mb-0">
        {{ __('Summary') }}
    </h3>
    <div class="order-summary-wrapper sticky-sidebar">
        {{-- <h3 class="title text-uppercase ls-10">{{ __('Summary') }}</h3> --}}
        <div class="order-summary">
            <table class="order-table">
                <tfoot>
                    <tr class="order-total">
                        <th>
                            {{ __('Subtotal') }}
                        </th>
                        <td>
                            <span class="amount">${{ number_format(str_replace(',', '', Cart::instance('default')->subtotal()), 2) }} {{ currency() }}</span>
                        </td>
                    </tr>
                    @if ($couponRequire && $this->coupon)
                        <tr class="order-total">
                            <th>
                                {{ __('Coupon') }}
                            </th>
                            <td>
                                <span class="amount">-{{ $coupon->percentage }}%</span>
                            </td>
                        </tr>
                    @endif
                    @if ($shippingApplies)
                        <tr class="order-total">
                            <th>
                                {{ __('Shipping price') }}
                            </th>
                            <td>
                                @if ((count($shippingZones) && !$shippingZoneId) || (!count($shippingZones)))
                                    {{ __('On hold') }}
                                @else
                                    ${{ number_format(str_replace(',', '', $shippingPrice) , 2) }} {{ currency() }}
                                @endif
                            </td>
                        </tr>
                        <tr class="order-total">
                            <th>
                                {{ __('Shipping days') }}
                            </th>
                            <td>
                                @if ((count($shippingZones) && !$shippingZoneId) || (!count($shippingZones)))
                                    {{ __('On hold') }}
                                @else
                                    {{ $shippingDays }}
                                @endif
                            </td>
                        </tr>
                    @endif
                    <tr class="order-total">
                        <th>
                            <b>{{ __('Total') }}</b>
                        </th>
                        <td>
                            @if (
                                ($shippingApplies && count($shippingZones) && !$shippingZoneId) ||
                                ($shippingApplies && !count($shippingZones))
                            )
                                {{ __('On hold') }}
                            @else
                                <b>${{ number_format(str_replace(',', '', $totalPrice), 2) }} {{ currency() }}</b>
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="form-group place-order pt-6">
                <div class="">
                    <button
                        wire:target.prevent="createOrder"
                        wire:loading.class="load-more-overlay loading"
                        wire:loading.disabled
                        type="submit"
                        class="btn btn-dark btn-block btn-rounded"
                        {{ ($shippingApplies && count($shippingZones) && !$shippingZoneId) ? 'disabled' : '' }}
                        {{ ($shippingApplies && !count($shippingZones)) ? 'disabled' : '' }}
                        >
                        <div wire:loading.remove wire:target="createOrder"><span> {{ __('Place order') }} <i class="ml-3 fa fa-arrow-right"></i></span></div>
                        <div wire:loading wire:target="createOrder"><span> {{ __('Generating order') }} ...</span></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
