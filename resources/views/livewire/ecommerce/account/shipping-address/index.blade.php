<!-- Start of PageContent -->
<div class="page-content pt-2">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">

            @include('ecommerce.account.menu.index')

            <div class="tab-content mb-6">
                <div class="tab-pane active in" id="account-addresses">
                    <div class="row mb-5">
                        <h4 class="title title-underline ls-25 font-weight-bold">
                            {{ __('Shipping addresses') }}
                        </h4>
                        <div class="btn-wrap mt-1">
                            <a href="{{ route('ecommerce.account.shipping-address.create') }}" class="btn btn-success btn-underline btn-link">
                                {{ __('New shipping address') }}
                            </a>
                        </div>
                    </div>
                    <div class="ecommerce-address shipping-address pr-lg-8">
                        @include('ecommerce.components.alert')
                        <div class="row">
                            @foreach ($shippingAddresses as $shippingAddress)
                                <div class="col-lg-6 mb-6">
                                    <address class="my-4">
                                        <table class="address-table">
                                            <tbody>
                                                <tr>
                                                    <th>{{ __('Default') }}</th>
                                                    <td>
                                                        @if ($shippingAddress->default)
                                                            {{ __('Yes') }} <i class="w-icon-heart-full"></i>
                                                        @else
                                                            {{ __('No') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Company') }}:</th>
                                                    <td>{{ $shippingAddress->company }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Name') }}:</th>
                                                    <td>{{ $shippingAddress->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Street') }}:</th>
                                                    <td>{{ $shippingAddress->street }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('City') }}:</th>
                                                    <td>{{ $shippingAddress->state->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Country') }}:</th>
                                                    <td>{{ $shippingAddress->state->country->name }} {{ $shippingAddress->state->country->code }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('State') }}:</th>
                                                    <td>{{ $shippingAddress->state->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Zip code') }}:</th>
                                                    <td>{{ $shippingAddress->zip_code }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{ __('Phone') }}:</th>
                                                    <td>{{ $shippingAddress->phone }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </address>
                                    <a href="{{ route('ecommerce.account.shipping-address.edit', $shippingAddress) }}" class="btn btn-link btn-underline btn-icon-right text-primary">
                                        {{ __('Edit your shipping address') }}
                                        <i class="w-icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of PageContent -->
