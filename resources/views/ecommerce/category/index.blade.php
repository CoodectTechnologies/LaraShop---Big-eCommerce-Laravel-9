
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Categories') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - {{ __('Categories') }}" />
    <meta name="description" content="{{ config('app.name') }} - {{ __('Categories') }}" />
    <meta http-equiv="title" content="{{ config('app.name') }} - {{ __('Categories') }}" />
    <meta property="og:title" content="{{ config('app.name') }} - {{ __('Categories') }}" />
    <meta property="og:description" content="{{ config('app.name') }} - {{ __('Categories') }}" />
    <meta name="description" content="{{ config('app.name') }} - {{ __('Categories') }}" />
    <meta name="keywords" content="{{ config('app.name') }}, {{ __('Categories') }}" />
    <meta property="og:url" content="{{ route('ecommerce.product.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - {{ __('Categories') }}" />
    <meta name="twitter:title" content="{{ config('app.name') }} - {{ __('Categories') }}" />
@endsection

@section('content')
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Categories') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb-nav -->

    @livewire('ecommerce.category.index')
@endsection
