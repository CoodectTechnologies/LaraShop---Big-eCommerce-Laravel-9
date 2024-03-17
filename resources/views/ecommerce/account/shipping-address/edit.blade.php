
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Edit shipping addresses') }}</title>
    <meta name="title" content="{{ config('app.name') }}"/>
    <meta name="description" content="{{ config('app.name') }}"/>
@endsection

@section('body-class') class="my-account" @endsection

@section('content')
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ __('Edit shipping addresses') }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('ecommerce.account.dashboard.index') }}">{{ __('My account') }}</a></li>
                <li><a href="{{ route('ecommerce.account.shipping-address.index') }}">{{ __('Shipping address') }}</a></li>
                <li class="active">{{ __('Edit shipping addresses') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    @livewire('ecommerce.account.shipping-address.form', ['shippingAddress' => $shippingAddress, 'method' => 'update'], key($shippingAddress->id))
@endsection


