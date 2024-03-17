
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Gallery') }} - {{ config('app.name') }} </title>
    <meta name="title" content="{{ config('app.name') }}"/>
    <meta name="description" content="{{ config('app.name') }}"/>
    <meta http-equiv="title" content="{{ config('app.name') }}"/>
    <meta property="og:title" content="{{ config('app.name') }}"/>
    <meta property="og:description" content="{{ config('app.name') }}"/>
    <meta name="description" content="{{ config('app.name') }}"/>
    <meta name="keywords" content="{{ config('app.name') }}," />
    <meta property="og:url" content="{{ route('ecommerce.gallery.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }}"/>
    <meta name="twitter:title" content="{{ config('app.name') }}"/>
@endsection

@section('content')
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ __('Gallery') }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-10 pb-8">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('ecommerce.gallery.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Gallery') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content mb-10 pb-2">

        <!-- Start of Masonry Grid Section -->
        <div class="instagram-masonry-grid mb-10 pb-6">
            <div class="container">
                <div class="row grid">
                    @foreach ($galleries as $gallery)
                        @foreach ($gallery->images as $image)
                            <div class="grid-item col-lg-4">
                                <figure class="instagram  br-sm">
                                    <a>
                                        <img src="{{ $image->imagePreview() }}" alt="{{ config('app.name') }}" width="610" height="220" />
                                    </a>
                                </figure>
                            </div>
                        @endforeach
                    @endforeach
                    <div class="grid-space col-1"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Page Content -->
@endsection

@section('footer')
    <script src="{{ asset('assets/ecommerce/vendor/isotope/isotope.pkgd.min.js') }}"></script>
@endsection
