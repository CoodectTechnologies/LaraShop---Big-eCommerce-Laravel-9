
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Complete') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - Complete" />
    <meta name="description" content="{{ config('app.name') }} - Complete" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Complete" />
    <meta property="og:title" content="{{ config('app.name') }} - Complete" />
    <meta property="og:description" content="{{ config('app.name') }} - Complete" />
    <meta name="description" content="{{ config('app.name') }} - Complete" />
    <meta name="keywords" content="{{ config('app.name') }}, Complete" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Complete" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Complete" />
@endsection

@section('content')
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb shop-breadcrumb bb-no">
                <li class="passed"><a disabled href="#">{{ __('Cart') }}</a></li>
                <li class="passed"><a disabled href="#">{{ __('Shipping') }}</a></li>
                <li class="passed"><a disabled href="#">{{ __('Payment') }}</a></li>
                <li class="active"><a disabled href="#">{{ __('Order complete') }}</a></li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    @livewire('ecommerce.checkout.complete', ['order' => $order])
@endsection
