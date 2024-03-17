
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ $product->name }}</title>
    <meta name="title" content="{{ config('app.name') }}"/>
    <meta name="description" content="{{ config('app.name') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/vendor/flipbook/css/flipbook.style.css') }}">
@endsection

@section('body-class') class="my-account" oncontextmenu="return false;" @endsection

@section('content')
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ $product->name }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('ecommerce.account.dashboard.index') }}">{{ __('My account') }}</a></li>
                <li><a href="{{ route('ecommerce.account.product-digital.index') }}">{{ __('My products digitals') }}</a></li>
                <li class="active">{{ $product->name }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->
    @livewire('ecommerce.account.product-digital.show', ['product' => $product])
@endsection
