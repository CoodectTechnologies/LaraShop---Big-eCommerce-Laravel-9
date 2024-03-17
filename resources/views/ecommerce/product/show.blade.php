
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ $product->name }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ $product->meta_title ?? $product->name }}" />
    <meta name="description" content="{{ $product->meta_description ?? $product->fragment }}" />
    <meta name="keywords" content="{{ $product->meta_keywords }}" />
    <meta http-equiv="title" content="{{ $product->name }}" />
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:description" content="{{ $product->name }}" />
    <meta property="og:url" content="{{ route('ecommerce.blog.show', $product) }}" />
    <meta name="twitter:description" content="{{ $product->name }}" />
    <meta name="twitter:title" content="{{ $product->name }}" />
    <meta property="product:brand" content="{{ $product->brand ? $product->brand->name : '' }}" />
    <meta property="product:price:amount" content="{{ $product->getPriceFinal() }}" />
    <meta property="product:price:currency" content="{{ Session::get('currency') }}" />
@endsection

@section('content')
   <!-- Start of Breadcrumb -->
   <nav class="breadcrumb-nav container">
        <ul class="breadcrumb bb-no">
            <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
            <li><a href="{{ route('ecommerce.product.index') }}">{{ __('Products') }}</a></li>
            <li class="active">{{ $product->name }}</li>
        </ul>
    </nav>
    <!-- End of Breadcrumb -->

    @livewire('ecommerce.product.show', ['product' => $product, 'productsViewRecents' => $productsViewRecents])
@endsection

@section('footer')
    <!-- Plugin JS File -->
    <script src="{{ asset('assets/ecommerce') }}/vendor/sticky/sticky.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/zoom/jquery.zoom.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/photoswipe/photoswipe.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/photoswipe/photoswipe-ui-default.js"></script>
@endsection
