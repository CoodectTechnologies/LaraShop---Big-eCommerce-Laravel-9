
@extends('ecommerce.layouts.main')

@section('head')
<title>{{ __('Contact') }} - {{ config('app.name') }} </title>
    <meta name="title" content="{{ config('app.name') }} - Contacto" />
    <meta name="description" content="{{ config('app.name') }} - Contacto" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Contacto" />
    <meta property="og:title" content="{{ config('app.name') }} - Contacto" />
    <meta property="og:description" content="{{ config('app.name') }} - Contacto" />
    <meta name="description" content="{{ config('app.name') }} - Contacto" />
    <meta name="keywords" content="{{ config('app.name') }}, Contacto" />
    <meta property="og:url" content="{{ route('ecommerce.contact.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Contacto" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Contacto" />
@endsection

@section('content')
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ __('Contact us') }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-10 pb-8">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('Contact us') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content contact-us">
        <div class="container">
            <section class="content-title-section mb-10">
                <h3 class="title title-center mb-3">
                    {{ __('Contact information') }}
                </h3>
                <p class="text-center">
                    Lorem ipsum dolor sit amet,
                    consectetur
                    adipiscing elit, sed do eiusmod tempor incididunt ut
                </p>
            </section>
            <!-- End of Contact Title Section -->

            <section class="contact-information-section mb-10">
                <div class="row owl-carousel owl-theme cols-xl-4 cols-md-3 cols-sm-2 cols-1" data-owl-options="{
                'items': 3,
                'nav': false,
                'dots': true,
                'loop': false,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 1
                    },
                    '480': {
                        'items': 2
                    },
                    '768': {
                        'items': 3
                    },
                    '992': {
                        'items': 3
                    }
                }
            }">
                    <div class="icon-box text-center icon-box-primary">
                        <span class="icon-box-icon icon-email">
                            <i class="w-icon-envelop-closed"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">{{ __('Email') }}</h4>
                            <p>
                                <a href="mailto:{{ config('contact.email') }}">
                                    {{ config('contact.email') }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="icon-box text-center icon-box-primary">
                        <span class="icon-box-icon icon-headphone">
                            <i class="w-icon-headphone"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">{{ __('Phone') }}</h4>
                            <p>
                                <a href="tel:{{ config('contact.phone') }}">{{ config('contact.phone') }}</a>
                            </p>
                        </div>
                    </div>
                    <div class="icon-box text-center icon-box-primary">
                        <span class="icon-box-icon icon-map-marker">
                            <i class="w-icon-map-marker"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">{{ __('Address') }}</h4>
                            <p>
                                <a href="http://maps.google.com" target="_blank" rel="noopener noreferrer">
                                    Zapopan Jalisco, México
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of Contact Information section -->

            <hr class="divider mb-10 pb-1">

            <section class="contact-section tab-content">
                <div class="row gutter-lg pb-3 justify-content-center">
                    @if (count($questionAnswers))
                        <div class="col-lg-6 mb-8">
                            <h4 class="title mb-3">{{ __('People usually ask these') }}</h4>
                            <div class="accordion accordion-bg accordion-gutter-md accordion-border">

                                @foreach ($questionAnswers as $questionAnswer)
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#collapse-{{ $questionAnswer->id }}" class="collapse">{{ $questionAnswer->question }}</a>
                                        </div>
                                        <div id="collapse-{{ $questionAnswer->id }}" class="card-body expanded">
                                            <p class="mb-0">
                                                {{ $questionAnswer->answer }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-6 mb-8">
                        <h4 class="title mb-3">{{ __('Send us a message') }}</h4>
                        @livewire('ecommerce.contact.index')
                    </div>
                </div>
            </section>
            <!-- End of Contact Section -->

        </div>

        {!! config('contact.map') !!}
    </div>
    <!-- End of PageContent -->
@endsection
