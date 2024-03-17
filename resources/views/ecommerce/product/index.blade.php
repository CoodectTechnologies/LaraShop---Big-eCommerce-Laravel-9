
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Products') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ __('Products') }} - {{ config('app.name') }}" />
    <meta name="description" content="{{ __('Products') }} - {{ config('app.name') }}" />
    <meta name="keywords" content="{{ config('app.name') }}, Productos" />
    <meta http-equiv="title" content="{{ __('Products') }} - {{ config('app.name') }}" />
    <meta property="og:title" content="{{ __('Products') }} - {{ config('app.name') }}" />
    <meta property="og:description" content="{{ __('Products') }} - {{ config('app.name') }}" />
    <meta property="og:url" content="{{ route('ecommerce.product.index') }}" />
    <meta name="twitter:description" content="{{ __('Products') }} - {{ config('app.name') }}" />
    <meta name="twitter:title" content="{{ __('Products') }} - {{ config('app.name') }}" />
@endsection

@section('content')
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Products') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb-nav -->

    @livewire('ecommerce.product.index')
@endsection
