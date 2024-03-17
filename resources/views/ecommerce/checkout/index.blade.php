
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Checkout') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - Checkout" />
    <meta name="description" content="{{ config('app.name') }} - Checkout" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Checkout" />
    <meta property="og:title" content="{{ config('app.name') }} - Checkout" />
    <meta property="og:description" content="{{ config('app.name') }} - Checkout" />
    <meta name="description" content="{{ config('app.name') }} - Checkout" />
    <meta name="keywords" content="{{ config('app.name') }}, Checkout" />
    <meta property="og:url" content="{{ route('ecommerce.checkout.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Checkout" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Checkout" />
@endsection

@section('content')
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a href="{{ route('ecommerce.cart.index') }}">{{ __('Cart') }}</a></li>
                <li class="active"><a href="{{ route('ecommerce.checkout.index') }}">{{ __('Shipping') }}</a></li>
                <li><a href="#" disabled>{{ __('Payment') }}</a></li>
                <li><a href="#" disbled>{{ __('Order complete') }}</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    @livewire('ecommerce.checkout.index')
@endsection
