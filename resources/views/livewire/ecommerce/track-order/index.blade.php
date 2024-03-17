<div>
    <div class="page-content mb-10">
        <div class="container">
            <div class="text-center mt-5">
                <h3 class="section-title">{{ __('Track order') }}</h3>
                <p class="text-default section-desc mx-auto">
                    {{ __('By entering your valid order number, you will be able to view the status of your order, and the tracking numbers associated with the order.') }}
                </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="vendor-search-wrapper open" style="display: block;">
                        <form wire:submit.prevent="trackOrder" class="vendor-search-form">
                            <input wire:model.defer="orderNumber" type="text" class="form-control mr-4 bg-white @error('orderNumber') invalid-feedback @enderror" name="orderNumber" id="orderNumber" placeholder="{{ __('Enter your order number') }}">
                            <button class="btn btn-primary btn-rounded" type="submit">{{ __('Consult') }}</button>
                        </form>
                        @error('orderNumber') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            @if ($order)
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <span class="text-header">{{ __('General information') }}</span>
                    </div>
                    <div class="card-body">
                        <ul class="order-view list-style-none">
                            <li>
                                <label>{{ __('Status') }}</label>
                                <strong>{!! $order->statusToString() !!}</strong>
                            </li>
                            <li>
                                <label>{{ __('Date created') }}</label>
                                <strong>{{ $order->created_at }}</strong>
                            </li>
                            <li>
                                <label>{{ __('Last update date') }}</label>
                                <strong>{{ $order->updated_at }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <span class="text-header">{{ __('Guides') }}</span>
                    </div>
                    <div class="card-body">
                        @forelse ($order->orderTrackings as $orderTracking)
                            <ul class="order-view list-style-none">
                                <li>
                                    <label>{{ __('Guide number') }} {{ $loop->iteration }}</label>
                                    <strong>{{  $orderTracking->number_tracking  }}</strong>
                                </li>
                                <li>
                                    <label>{{ __('Guide') }}</label>
                                    <strong>
                                        @if ($orderTracking->link_tracking)
                                            <a href="{{ $orderTracking->link_tracking }}" target="_blank" rel="noopener noreferrer">
                                                {{ $orderTracking->link_tracking }}
                                            </a>
                                        @else
                                            Aun sin link de guia
                                        @endif
                                    </strong>
                                </li>
                            </ul>
                        @empty
                            <div class="d-flex justify-content-center">
                                <div class="col-md-6 mb-4">
                                    <div class="text-center alert alert-warning alert-simple alert-inline">
                                        {{ __('This order does not yet contain guides') }}
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
