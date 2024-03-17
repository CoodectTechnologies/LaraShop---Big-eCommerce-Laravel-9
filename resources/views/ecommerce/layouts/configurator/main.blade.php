<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Meta Tags --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta http-equiv="Content-Language" content="es" />
    <meta name="author" content="{{ config('app.name') }}" />
    <meta name="resource-type" content="document" />
    <meta name="Revisit" content="2 days" />
    <meta name="robots" content="all"/>
    <meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{ asset('assets/admin/media/logo/favicons/android-icon-192x192.png') }}" />
    <meta property="og:site_name" content="" />
    <meta name="twitter:card" content="summary" />

    {{-- Favicons --}}
    @include('admin.components.favicons')

    {{-- Noscript --}}
    <noscript>Your browser does not support JavaScript!</noscript>
    {{-- Script defer --}}
    <script defer src="{{ asset('assets/admin/js/custom/alpine/alpine.js') }}"></script>

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/var.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/photoswipe/photoswipe.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce') }}/vendor/photoswipe/default-skin/default-skin.min.css">
    @yield('skin')
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/custom.css') }}">

    {{-- Livewire --}}
    @livewireStyles

    {{-- Production --}}
    @production
        @livewire('ecommerce.layouts.tag-analytic-header')
    @endproduction

    {{-- Custom --}}
    @yield('head')
    @stack('head')
</head>

<body @yield('body-class')>
    <div class="page-wrapper">
        @include('ecommerce.layouts.configurator.header')
        <main class="main">
            @yield('content')
        </main>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('assets/ecommerce') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/ecommerce/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/jquery.plugin/jquery.plugin.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/jquery.countdown/jquery.countdown.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/floating-parallax/parallax.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/js/main.js"></script>
    @livewireScripts
    @include('ecommerce.components.cart-added')
    @yield('footer')
	@stack('footer')
    {{-- Production --}}
    @production
        @livewire('ecommerce.layouts.tag-analytic-footer')
    @endproduction
</body>
</html>
