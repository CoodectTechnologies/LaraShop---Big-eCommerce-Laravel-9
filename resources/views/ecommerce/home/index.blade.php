
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('Home') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ __('Home') }} - {{ config('app.name') }}" />
    <meta name="description" content="{{ __('Home') }} - {{ config('app.name') }}" />
    <meta http-equiv="title" content="{{ __('Home') }} - {{ config('app.name') }}" />
    <meta property="og:title" content="{{ __('Home') }} - {{ config('app.name') }}" />
    <meta property="og:description" content="{{ __('Home') }} - {{ config('app.name') }}" />
    <meta name="description" content="{{ __('Home') }} - {{ config('app.name') }}" />
    <meta name="keywords" content="{{ config('app.name') }}, Ecommerce" />
    <meta property="og:url" content="{{ route('ecommerce.home.index') }}" />
    <meta name="twitter:description" content="{{ __('Home') }} - {{ config('app.name') }}" />
    <meta name="twitter:title" content="{{ __('Home') }} - {{ config('app.name') }}" />
@endsection

@section('skin')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ecommerce/css/demo2.min.css') }}">
@endsection

@section('body-class') class="home" @endsection

@section('content')
    <div class="intro-section">
        <div class="owl-carousel owl-theme owl-nav-inner owl-dot-inner row gutter-no cols-1 animation-slider"
            data-owl-options="{
            'nav': true,
            'dots': true,
            'items': 1,
            'autoplay': true,
            'autoHeight':true,
            'responsive': {
                '1630': {
                    'nav': true,
                    'dots': false
                }
            }
        }">
            @foreach ($bannersPrimary as $bannerPrimary)
                <div class="banner banner-fixed intro-slide intro-slide3"
                    style=" background-image: @if($bannerPrimary->overlay) linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), @endif url({{ $bannerPrimary->imagePreview() }});">
                    <div class="container">
                        <div class="banner-content y-50">
                            @if ($bannerPrimary->subtitle)
                                <h5 style="color: {{ $bannerPrimary->color }}" class="banner-subtitle text-uppercase font-weight-bold slide-animate"
                                    data-animation-options="{
                                    'name': 'fadeInRightShorter', 'duration': '1s'
                                }">{{ $bannerPrimary->subtitle }}</h5>
                            @endif
                            @if ($bannerPrimary->title)
                                <h4 style="color: {{ $bannerPrimary->color }}" class="banner-title ls-25 slide-animate" data-animation-options="{
                                    'name': 'fadeInRightShorter', 'duration': '1s'
                                }">{{ $bannerPrimary->title }}</h4>
                            @endif
                            @if ($bannerPrimary->btn_text)
                                <a href="{{ $bannerPrimary->btn_url }}"
                                    style="color: {{ $bannerPrimary->color }}" class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                    data-animation-options="{
                                    'name': 'fadeInRightShorter', 'duration': '1s'
                                }">{{ $bannerPrimary->btn_text }}<i class="w-icon-long-arrow-right"></i></a>
                            @endif
                        </div>
                        <!-- End of .banner-content -->
                    </div>
                    <!-- End of .container -->
                </div>
                <!-- End of .intro-slide -->
            @endforeach
        </div>
    </div>
    <!-- End of .intro-section -->

    <div class="container">
        <div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1 icon-box-wrapper br-sm mt-6 mb-10 appear-animate"
            data-owl-options="{
            'nav': true,
            'dots': false,
            'loop': true,
            'autoplay': true,
            'autoplayTimeout': 4000,
            'responsive': {
                '0': {
                    'items': 1
                },
                '576': {
                    'items': 2
                },
                '768': {
                    'items': 3
                },
                '992': {
                    'items': 3
                },
                '1200': {
                    'items': 4
                }
            }}">
            <div class="icon-box icon-box-side text-dark">
                <span class="icon-box-icon icon-shipping">
                    <i class="w-icon-truck"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title">{{ __('Safe shipments') }}</h4>
                    <p class="text-default">{{ __('All shipments insured') }}</p>
                </div>
            </div>
            <div class="icon-box icon-box-side text-dark">
                <span class="icon-box-icon icon-payment">
                    <i class="w-icon-bag"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title">{{ __('Secure Payment') }}</h4>
                    <p class="text-default">{{ __('We ensure secure payment') }}</p>
                </div>
            </div>
            <div class="icon-box icon-box-side text-dark icon-box-money">
                <span class="icon-box-icon icon-money">
                    <i class="w-icon-money"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title">{{ __('Money back guarantee') }}</h4>
                    <p class="text-default">{{ __('Any back within 30 days') }}</p>
                </div>
            </div>
            <div class="icon-box icon-box-side text-dark icon-box-chat">
                <span class="icon-box-icon icon-chat">
                    <i class="w-icon-chat"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title">{{ __('Customer Support') }}</h4>
                    <p class="text-default">{{ __('Call or email us 24/7') }}</p>
                </div>
            </div>
        </div>
        <!-- End of Iocn Box Wrapper -->

        @if (count($productsMostSelled))
            <div class="title-link-wrapper mb-3 appear-animate">
                <h2 class="title title-deals mb-1">{{ __('Best sellers') }}</h2>
                <div class="product-countdown-container font-size-sm text-dark align-items-center">
                    {{-- <label>Offer Ends in: </label>
                    <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+1d"
                        data-relative="true" data-compact="true">10days,00:00:00</div> --}}
                </div>
            </div>
            <!-- End of .title-link-wrapper -->

            <div class="owl-carousel owl-theme row cols-lg-5 cols-md-4 cols-2 product-deals-wrapper appear-animate mb-7"
                data-owl-options="{
                'nav': true,
                'dots': true,
                'items': 5,
                'autoplay': false,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2,
                        'nav': false
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 4
                    },
                    '992': {
                        'items': 5
                    }
                }}">
                @foreach ($productsMostSelled as $productMostSelled)
                    @include('ecommerce.product.partials.index._product', ['product' => $productMostSelled])
                @endforeach
            </div>
            <!-- End of Product Deals Warpper -->
        @endif

        @if (count($productsFeatured))
            <div class="title-link-wrapper mb-3 appear-animate">
                <h2 class="title title-deals mb-1">{{ __('Featured') }}</h2>
                <div class="product-countdown-container font-size-sm text-dark align-items-center">
                    {{-- <label>Offer Ends in: </label>
                    <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+1d"
                        data-relative="true" data-compact="true">10days,00:00:00</div> --}}
                </div>
                <a href="{{ route('ecommerce.product.index') }}" class="font-weight-bold ls-25">{{ __('More products') }}<i class="w-icon-long-arrow-right"></i></a>
            </div>
            <!-- End of .title-link-wrapper -->
            <div class="owl-carousel owl-theme row cols-lg-5 cols-md-4 cols-2 product-deals-wrapper appear-animate mb-7"
                data-owl-options="{
                'nav': true,
                'dots': true,
                'items': 5,
                'autoplay': false,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2,
                        'nav': false
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 4
                    },
                    '992': {
                        'items': 5
                    }
                }}">
                @foreach ($productsFeatured as $productFeatured)
                    @include('ecommerce.product.partials.index._product', ['product' => $productFeatured])
                @endforeach
            </div>
            <!-- End of Product Deals Warpper -->
        @endif

        @if (count($productsNew))
            <div class="title-link-wrapper mb-3 appear-animate">
                <h2 class="title title-deals mb-1">{{ __('New products') }}</h2>
                <div class="product-countdown-container font-size-sm text-dark align-items-center">
                    {{-- <label>Offer Ends in: </label>
                    <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+1d"
                        data-relative="true" data-compact="true">10days,00:00:00</div> --}}
                </div>
                <a href="{{ route('ecommerce.product.index') }}" class="font-weight-bold ls-25">{{ __('More products') }}<i class="w-icon-long-arrow-right"></i></a>
            </div>
            <!-- End of .title-link-wrapper -->
            <div class="owl-carousel owl-theme row cols-lg-5 cols-md-4 cols-2 product-deals-wrapper appear-animate mb-7"
                data-owl-options="{
                'nav': true,
                'dots': true,
                'items': 5,
                'autoplay': false,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2,
                        'nav': false
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 4
                    },
                    '992': {
                        'items': 5
                    }
                }}">
                @foreach ($productsNew as $productNew)
                    @include('ecommerce.product.partials.index._product', ['product' => $productNew])
                @endforeach
            </div>
            <!-- End of Product Deals Warpper -->
        @endif



        <div class="row category-wrapper electronics-cosmetics appear-animate mb-7">
            @foreach ($bannersSecondary as $bannerSecondary)
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-sm">
                        <figure>
                            <img src="{{ $bannerSecondary->imagePreview() }}" alt="{{ $bannerSecondary->title }}"
                                width="640" height="200" style="background-color: #25282D;" />
                        </figure>
                        <div class="banner-content y-50 text-right">
                            <h3 style="color: {{ $bannerSecondary->color }}" class="banner-title ls-25 mb-0">{{ $bannerSecondary->title }}</h3>
                            <div style="color: {{ $bannerSecondary->color }}" class="banner-price-info font-weight-bold text-uppercase mb-1">
                                {{ $bannerSecondary->subtitle }}
                                {{-- <strong class="text-secondary">$125.00</strong> --}}
                            </div>
                            <hr class="banner-divider bg-white" />
                            @if ($bannerSecondary->btn_url)
                                <a style="color: {{ $bannerSecondary->color }}" href="{{ $bannerSecondary->btn_url }}" class="btn btn-white btn-link btn-underline btn-icon-right">
                                    {{ $bannerSecondary->btn_text }} <i class="w-icon-long-arrow-right"></i>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End of Category Wrapper -->

        @foreach ($categoriesFhater as $categoryFhater)
            <div class="banner-product-wrapper appear-animate row mb-8">
                <div class="col-xl-5col col-md-4 mb-4">
                    <div class="categories h-100">
                        <h2 class="title text-left"><a href="{{ route('ecommerce.product.index', ['category' => $categoryFhater->slug]) }}">{{ $categoryFhater->name }}</a></h2>
                        <ul class="list-style-none mb-4">
                            @foreach ($categoryFhater->childrens as $categoryChildren)
                                <li><a href="{{ route('ecommerce.product.index', ['category' => $categoryChildren->slug]) }}">{{ $categoryChildren->name }}</a></li>
                                @if ($loop->iteration >= 6)
                                    @break
                                @endif
                            @endforeach
                        </ul>
                        @if (count($categoryFhater->childrens) >= 6)
                            <a
                                href="{{ route('ecommerce.category.index', ['category' => $categoryFhater->slug]) }}"
                                class="btn btn-dark btn-link btn-underline btn-icon-right font-weight-bolder text-capitalize ls-50">
                                {{ __('Search all') }}
                                <i class="w-icon-long-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-xl-5col4 col-md-8 mb-4">
                    <div class="owl-carousel owl-theme row cols-xl-4 cols-lg-3" data-owl-options="{
                        'nav': true,
                        'dots': true,
                        'margin': 20,
                        'responsive': {
                            '0': {
                                'items': 2
                            },
                            '576': {
                                'items': 3
                            },
                            '768': {
                                'items': 2
                            },
                            '992': {
                                'items': 3
                            },
                            '1200': {
                                'items': 4
                            }
                        }
                    }">
                        @foreach ($categoryFhater->products as $product)
                            @include('ecommerce.product.partials.index._product', ['product' => $product])
                        @endforeach
                    </div>
                    <!-- End fo Carousel -->
                </div>
            </div>
        @endforeach
        <!-- End of Banner Product Wrapper -->

        @if ($productsViewRecents)
            <h2 class="title text-left text-capitalize mb-5 appear-animate">{{ __('Recently viewed') }}</h2>
            <div class="owl-carousel owl-theme appear-animate viewed-products row cols-xl-8 cols-lg-6 cols-md-4 cols-2 mb-7"
                data-owl-options="{
                'nav': true,
                'dots': true,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 5
                    },
                    '992': {
                        'items': 6
                    },
                    '1200': {
                        'items': 8,
                        'dots': true
                    }
                }
                }">
                @foreach ($productsViewRecents as $productsViewRecent)
                    <div class="product-wrap">
                        <div class="product text-center product-absolute">
                            <figure class="product-media">
                                <a href="{{ route('ecommerce.product.show', $productsViewRecent) }}">
                                    <img src="{{ $productsViewRecent->imagePreview() }}" alt="{{ $productsViewRecent->name }}"
                                        width="300" style="background-color: #fff" />
                                </a>
                            </figure>
                            <h4 class="product-name">
                                <a href="{{ route('ecommerce.product.show', $productsViewRecent) }}">{{ $productsViewRecent->name }}</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End of Product Wrap -->
                @endforeach
            </div>
            <!-- End of Owl Carousel -->
        @endif

        @if (count($partners))
            <h2 class="title text-left mb-5 appear-animate">{{ __('Our clients') }}</h2>
            <div class="owl-carousel owl-theme row cols-xl-8 cols-lg-6 cols-md-4 cols-sm-3 cols-2 brands-wrapper br-sm mb-10 appear-animate"
                data-owl-options="{
                'nav': true,
                'dots': false,
                'autoplay': true,
                'autoplayTimeout': 4000,
                'loop': true,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 4
                    },
                    '992': {
                        'items': 6
                    },
                    '1200': {
                        'items': 8
                    }
                }
                }">
                @foreach ($partners as $partner)
                    <figure>
                        <img src="{{ $partner->imagePreview() }}" alt="{{ $partner->name }}" width="290"/>
                    </figure>
                @endforeach
            </div>
            <!-- End of Brands Wrapper -->
        @endif
    </div>
    <!-- End of Container -->
@endsection

@section('footer')
    @livewire('ecommerce.popup.js')
@endsection
