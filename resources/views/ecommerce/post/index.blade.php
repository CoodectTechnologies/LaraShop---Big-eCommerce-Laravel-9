
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Posts') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - Blog" />
    <meta name="description" content="{{ config('app.name') }} - Blog" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Blog" />
    <meta property="og:title" content="{{ config('app.name') }} - Blog" />
    <meta property="og:description" content="{{ config('app.name') }} - Blog" />
    <meta name="description" content="{{ config('app.name') }} - Blog" />
    <meta name="keywords" content="{{ config('app.name') }}, Blog" />
    <meta property="og:url" content="{{ route('ecommerce.blog.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Blog" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Blog" />
@endsection

@section('content')
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ __('Blog') }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ __('Blog') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb-nav -->

    @livewire('ecommerce.blog.index')
@endsection
