<div class="cart">
    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            @include('ecommerce.components.alert')
            @if (!count($cart))
                <div class="text-center alert alert-primary alert-bg alert-button alert-block">
                    <h4 class="alert-title">{{ __('Empty cart list') }}</h4>
                    {{ __('In this section you will be shown all the products that you have added to your wishlist') }}
                    <br>
                    <a href="{{ route('ecommerce.product.index') }}" class="btn btn-primary btn-rounded">{{ __('Show products') }}</a>
                    <button class="btn btn-link btn-close">
                        <i class="close-icon"></i>
                    </button>
                </div>
            @else
                @if (count($getShippingZonesFreeShippingOverTo))
                    <section class="mb-10 pb-1">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                @foreach ($getShippingZonesFreeShippingOverTo as $shippingZone)
                                    @php
                                        $free = false;
                                        $missingAmount = 0;
                                        $fSubtotal = floatval(str_replace(',', '', $subtotal));
                                        if($shippingZone->free_shipping_over_to <= $fSubtotal):
                                            $free = true;
                                        else:
                                            $missingAmount = ($shippingZone->free_shipping_over_to - $fSubtotal);
                                        endif;
                                    @endphp
                                    @if ($free)
                                        <div class="alert alert-icon alert-success alert-bg alert-inline">
                                            <h4 class="alert-title">
                                                <i class="fas fa-check"></i>
                                                {{ $shippingZone->alias }} - Aplica envío gratis <br>
                                                <span class="">
                                                    Aplica para: {{ $shippingZone->country->name }}
                                                    ( @foreach ($shippingZone->states as $state) {{ $state->name }} @endforeach )
                                                    @if ($shippingZone->zip_codes)
                                                        , Restringido a los codigos postales {{ $shippingZone->zip_codes }}
                                                    @endif
                                                </span>
                                            </h4>
                                        </div>
                                    @else
                                        <div class="alert alert-icon alert-warning alert-bg alert-inline">
                                            <h4 class="alert-title">
                                                {{ $shippingZone->alias }} - Aumenta <strong>${{ number_format($missingAmount, 2) }}</strong> para obtener este envio gratis. <br>
                                                <span class="">
                                                    Aplica para: {{ $shippingZone->country->name }}
                                                    ( @foreach ($shippingZone->states as $state) {{ $state->name }} @endforeach )
                                                    @if ($shippingZone->zip_codes)
                                                        , Restringido a los codigos postales {{ $shippingZone->zip_codes }}
                                                    @endif
                                                </span>
                                            </h4>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        <table class="shop-table cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name"><span>{{ __('Product') }}</span></th>
                                    <th></th>
                                    <th class="product-price"><span>{{ __('Price') }}</span></th>
                                    <th class="product-quantity"><span>{{ __('Quantity') }}</span></th>
                                    <th class="product-subtotal"><span>{{ __('Subtotal') }}</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                                    <figure>
                                                        <img src="{{ $item->options->image }}" alt="{{ $item->name }}"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button wire:click="delete('{{ $item->rowId }}')"
                                                    wire:target="delete('{{ $item->rowId }}')"
                                                    wire:loading.class="load-more-overlay loading"
                                                    class="btn btn-close"
                                                    type="submit">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                                {{ $item->name }}
                                            </a> <br>
                                            @if (isset($item->options->color['name']))
                                                {{ __('Color') }}: {{ $item->options->color['name'] }} <br>
                                            @endif
                                            @if (isset($item->options->size['name']))
                                                {{ __('Size') }}: {{ $item->options->size['name'] }} <br>
                                            @endif
                                            @if ($item->options->type)
                                                {{ __('Type') }}: {{ $item->options->type }}
                                            @endif
                                        </td>
                                        <td class="product-price"><span class="amount">${{ number_format($item->price, 2) }} {{ $item->options->currency }}</span></td>
                                        <td class="product-quantity">
                                            @if (!$item->options->type || $item->options->type == 'Físico')
                                                <div class="input-group">
                                                    <input wire:change="update({{ $item->model->id }}, '{{ $item->rowId }}', $event.target.value)" value="{{ $item->qty }}" class="form-control" type="number">
                                                    <button wire:click="update({{ $item->model->id }}, '{{ $item->rowId }}', {{ ($item->qty + 1) }})" class="quantity-plus w-icon-plus"></button>
                                                    <button wire:click="update({{ $item->model->id }}, '{{ $item->rowId }}', {{ ($item->qty - 1) }})" class="quantity-minus w-icon-minus"></button>
                                                </div>
                                            @else
                                                {{ $item->qty }}
                                            @endif
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">${{ number_format($item->subtotal, 2) }} {{ $item->options->currency }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="cart-action mb-6">
                            <a href="{{ route('ecommerce.product.index') }}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>{{ __('Continue shopping') }}</a>
                            <button wire:click="deleteCart" type="submit" class="btn btn-rounded btn-default btn-clear">{{ __('Clear cart') }}</button>
                        </div>

                    </div>
                    <div class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar">
                            <div class="cart-summary mb-4">
                                <h3 class="cart-title text-uppercase">{{ __('Cart subtotals') }}</h3>
                                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                    <label class="ls-25">{{ __('Subtotal') }}</label>
                                    <span>${{ $subtotal }} {{ currency() }}</span>
                                </div>
                                <hr class="divider mb-6">
                                @if(Route::has('ecommerce.checkout.index'))
                                    <a href="{{ route('ecommerce.checkout.index') }}"
                                        class="btn btn-block btn-dark btn-icon-right btn-rounded btn-checkout">
                                        {{ __('Proceed to checkout') }}
                                        <i class="w-icon-long-arrow-right"></i>
                                    </a>
                                @endif
                                @if(Route::has('ecommerce.checkout.whatsapp'))
                                    <a target="_blank" href="{{ route('ecommerce.checkout.whatsapp') }}"
                                        class="btn btn-block btn-success btn-icon-right btn-rounded btn-checkout"
                                        style="border-color: #25d366; background-color: #25d366;">
                                        {{ __('Proceed order by') }} <i class="fab fa-whatsapp fa-4x"></i>
                                        <i class="w-icon-long-arrow-right"></i>

                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- End of PageContent -->
</div>
