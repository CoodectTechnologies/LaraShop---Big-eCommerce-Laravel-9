
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Payment') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - Payment" />
    <meta name="description" content="{{ config('app.name') }} - Payment" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Payment" />
    <meta property="og:title" content="{{ config('app.name') }} - Payment" />
    <meta property="og:description" content="{{ config('app.name') }} - Payment" />
    <meta name="description" content="{{ config('app.name') }} - Payment" />
    <meta name="keywords" content="{{ config('app.name') }}, Payment" />
    <meta name="twitter:description" content="{{ config('app.name') }} - payment" />
    <meta name="twitter:title" content="{{ config('app.name') }} - payment" />
@endsection

@section('content')
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a disabled href="{{ route('ecommerce.cart.index') }}">{{ __('Cart') }}</a></li>
                <li class="passed"><a disabled href="#">{{ __('Shipping') }}</a></li>
                <li  class="active"><a href="#">{{ __('Payment') }}</a></li>
                <li><a href="#" disbled>{{ __('Order complete') }}</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    @livewire('ecommerce.checkout.payment', ['order' => $order])
@endsection
