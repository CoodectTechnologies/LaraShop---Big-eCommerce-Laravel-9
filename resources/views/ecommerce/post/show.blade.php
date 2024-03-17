
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ $post->name }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ $post->meta_title ?? $post->name }}" />
    <meta name="description" content="{{ $post->meta_description ?? $post->fragment }}" />
    <meta name="keywords" content="{{ $post->meta_keywords }}" />
    <meta http-equiv="title" content="{{ $post->name }}" />
    <meta property="og:title" content="{{ $post->name }}" />
    <meta property="og:description" content="{{ $post->name }}" />
    <meta property="og:url" content="{{ route('ecommerce.product.show', $post) }}" />
    <meta name="twitter:description" content="{{ $post->name }}" />
    <meta name="twitter:title" content="{{ $post->name }}" />
@endsection

@section('content')
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ $post->name }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li class="active">{{ $post->name }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb-nav -->

    @livewire('ecommerce.blog.show', ['post' => $post])
@endsection
