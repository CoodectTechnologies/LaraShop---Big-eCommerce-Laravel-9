<!-- Start of PageContent -->
<div class="page-content pt-2">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">

            @include('ecommerce.account.menu.index')

            <div class="main-content">
                <div class="tab-pane active in" id="account-orders">
                    <div class="icon-box icon-box-side icon-box-light">
                        <span class="icon-box-icon icon-orders">
                            <i class="w-icon-orders"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-capitalize ls-normal mb-0">{{ __('Orders') }}</h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="shop-table account-orders-table mb-6">
                            <thead>
                                <tr>
                                    <th style="min-width: 100px;" class="order-id">{{ __('Order') }}</th>
                                    <th style="min-width: 100px;" class="order-date">{{ __('Date') }}</th>
                                    <th style="min-width: 100px;" class="order-status">{{ __('Status') }}</th>
                                    <th style="min-width: 100px;" class="order-status">{{ __('Payment status') }}</th>
                                    <th style="min-width: 100px;" class="order-total">{{ __('Total') }}</th>
                                    <th style="min-width: 100px;" class="order-actions">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="order-id">#{{ $order->number }}</td>
                                        <td class="order-date">{{ $order->dateToString() }}</td>
                                        <td class="order-status">{!! $order->statustoString() !!}</td>
                                        <td class="order-status">{!! $order->paymentStatustoString() !!}</td>
                                        <td class="order-total">
                                            <span class="order-price">{!! $order->totalToString() !!}</span>
                                            <span class="order-quantity"> ({{ $order->products()->count() }})</span> {{ __('item(s)') }}
                                        </td>
                                        <td class="order-action">
                                            <a href="{{ route('ecommerce.account.order.show', $order) }}"
                                                class="btn btn-outline btn-default btn-block btn-sm btn-rounded">{{ __('View') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('ecommerce.product.index') }}" class="btn btn-dark btn-rounded btn-icon-right">
                        {{ __('Go shop') }}<i class="w-icon-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of PageContent -->
