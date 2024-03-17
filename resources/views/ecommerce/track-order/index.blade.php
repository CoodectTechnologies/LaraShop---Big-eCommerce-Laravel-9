
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ config('app.name') }} - {{ __('Track order') }}</title>
    <meta name="title" content="{{ config('app.name') }} - {{ __('Track order') }}" />
    <meta name="description" content="{{ config('app.name') }} - {{ __('Track order') }}" />
    <meta http-equiv="title" content="{{ config('app.name') }} - {{ __('Track order') }}" />
    <meta property="og:title" content="{{ config('app.name') }} - {{ __('Track order') }}" />
    <meta property="og:description" content="{{ config('app.name') }} - {{ __('Track order') }}" />
    <meta name="description" content="{{ config('app.name') }} - {{ __('Track order') }}" />
    <meta name="keywords" content="{{ config('app.name') }}, {{ __('Track order') }}" />
    <meta property="og:url" content="{{ route('ecommerce.product.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - {{ __('Track order') }}" />
    <meta name="twitter:title" content="{{ config('app.name') }} - {{ __('Track order') }}" />
@endsection

@section('content')
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Track order') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb-nav -->

    @livewire('ecommerce.track-order.index')
@endsection
