<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--================================================
	META
	=================================================-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta name="description" content="Diseño de páginas Web, Aplicaciones Web, Desarrollo Web en Guadalajara, Jalisco, México. Tiendas en línea, Posicionamiento Web, Diseño gráfico, Publicidad en redes sociales.">
	<meta name="keywords" content="Desarrollo web, Marketing digital, Diseño gráfico, Diseño de sitios, Estrategias de marketing en línea, Diseño de logotipos"/>
    <meta name="author" content="{{ config('app.url') }}">
	<meta name="robots" content="index, follow">
    <meta name="Revisit" content="2 days" />
    <meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
	<!--================================================
	SCHEMA MARKUP FOR GOOGLE
	=================================================-->
	<meta itemprop="name" content="🥇 Diseño de Páginas Web en Guadalajara, Jalisco. Desarrollo Web, Diseño gráfico, Redes sociales en México." />
	<meta itemprop="description" content="Diseño de páginas Web, Aplicaciones Web, Desarrollo Web en Guadalajara, Jalisco, México. Tiendas en línea, Posicionamiento Web, Diseño gráfico, Publicidad en redes sociales." />
	<meta itemprop="image" content="{{ asset('assets/admin/media/logo/logo_favicon.webp') }}" />
	<!--================================================
	OPEN GRAPH DATA
	=================================================-->
	<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
	<meta property="og:title" content="🥇 Diseño de Páginas Web en Guadalajara, Jalisco. Desarrollo Web, Diseño gráfico, Redes sociales en México." />
	<meta property="og:description" content="Diseño de páginas Web, Aplicaciones Web, Desarrollo Web en Guadalajara, Jalisco, México. Tiendas en línea, Posicionamiento Web, Diseño gráfico, Publicidad en redes sociales." />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ config('app.url') }}" />
	<meta property="og:site_name" content="{{ config('app.name') }}" />
	<meta property="og:image" content="{{ asset('assets/admin/media/logo/logo_favicon.webp') }}" />
    <meta property="og:image:secure_url" content="{{ asset('assets/admin/media/logo/logo_favicon.webp') }}" />
	<meta property="og:image:width" content="200" />
	<meta property="og:image:height" content="200" />
    <meta property="og:image:type" content="image/png" />
	<meta property="og:image:alt" content="{{ config('app.name') }}" />
	<!--================================================
	TWITTER CARD DATA
	=================================================-->
	<meta name="twitter:title" content="🥇 Diseño de Páginas Web en Guadalajara, Jalisco. Desarrollo Web, Diseño gráfico, Redes sociales en México." />
	<meta name="twitter:description" content="Diseño de páginas Web, Aplicaciones Web, Desarrollo Web en Guadalajara, Jalisco, México. Tiendas en línea, Posicionamiento Web, Diseño gráfico, Publicidad en redes sociales." />
	<meta name="twitter:image" content="{{ asset('assets/admin/media/logo/logo_favicon.webp') }}" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@coodect" />
	<meta name="twitter:creator" content="@coodect" />
    <!--================================================
	CSS
	=================================================-->
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
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/custom-dark.css') }}">
    <script defer src="{{ asset('assets/admin/js/custom/alpine/alpine.js') }}"></script>
    <!--================================================
	NOSCRIPTS
	=================================================-->
    <noscript>Your browser does not support JavaScript!</noscript>
    <!--================================================
	FAVICONS
	=================================================-->
    @include('admin.components.favicons')
    <!--================================================
	LIVEWIRE CSS
	=================================================-->
    @livewireStyles
    <!--================================================
	CUSTOM
	=================================================-->
    @yield('head')
    @stack('head')
    @production
        @livewire('ecommerce.layouts.tag-analytic-header')
    @endproduction
</head>

<body @yield('body-class')>
    <div class="page-wrapper">
        @include('ecommerce.layouts.header')
        <main class="main">
            @yield('content')
        </main>
        @include('ecommerce.layouts.footer')
    </div>
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
    @include('ecommerce.layouts.menu-mobile.index')
    <!--================================================
	RICH SNIPPET
	=================================================-->
	<script type='application/ld+json'>
        {
            "@context": "http://www.schema.org",
            "@type": "Organization",
            "name": "{{ config('app.name') }}",
            "url": "{{ config('app.url') }}",
            "logo": "{{ asset(config('app.logo')) }}",
            "description": "Desarrollo de p&aacute;ginas Web en Guadalajara, Jalisco, México con tecnología HTML5, CSS3, PHP, MySQL, y jQuery, con los frameworks FuelPHP, Laravel o CodeIgniter.",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Real de tesistan",
                "addressLocality": "Zapopan",
                "addressRegion": "Jalisco",
                "postalCode": "45200",
                "addressCountry": "México"
            },
            "geo": {
                "@type": "GeoCoordinates"
            },
            "openingHours": "Mo, Tu, We, Th, Fr 09:00-18:00",
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "sales",
                "telephone": "{{ config('contact.phone') }}",
                "email": "{{ config('contact.email') }}",
                "url": "{{ config('app.url') }}"
            }
        }
    </script>
    <!--================================================
	JAVASCRIPT
	=================================================-->
    <script src="{{ asset('assets/ecommerce') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/ecommerce/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/jquery.plugin/jquery.plugin.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/jquery.countdown/jquery.countdown.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/vendor/floating-parallax/parallax.min.js"></script>
    <script src="{{ asset('assets/ecommerce') }}/js/main.js"></script>
    <!--================================================
	LIVEWIRE JAVASCRIPT
	=================================================-->
    @livewireScripts
    <!--================================================
    CUSTOM JAVASCRIPT
    =================================================-->
    @include('ecommerce.components.cart-added')
    @yield('footer')
	@stack('footer')
    @production
        @livewire('ecommerce.layouts.tag-analytic-footer')
    @endproduction
</body>
</html>
