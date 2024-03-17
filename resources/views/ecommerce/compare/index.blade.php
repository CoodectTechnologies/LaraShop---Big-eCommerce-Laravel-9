
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Compare') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }}"/>
    <meta name="description" content="{{ config('app.name') }}"/>
    <meta http-equiv="title" content="{{ config('app.name') }}"/>
    <meta property="og:title" content="{{ config('app.name') }}"/>
    <meta property="og:description" content="{{ config('app.name') }}"/>
    <meta name="description" content="{{ config('app.name') }}"/>
    <meta name="keywords" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ route('ecommerce.cart.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }}"/>
    <meta name="twitter:title" content="{{ config('app.name') }}"/>
@endsection

@section('content')

    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ __('Compare') }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-10">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Compare') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    @include('ecommerce.components.alert')

    @livewire('ecommerce.compare.index')

@endsection
