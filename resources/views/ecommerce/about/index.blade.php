
@extends('ecommerce.layouts.main')

@section('head')
    <title>{{ __('About') }} - {{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }} - Nosotros" />
    <meta name="description" content="{{ config('app.name') }} - Nosotros" />
    <meta http-equiv="title" content="{{ config('app.name') }} - Nosotros" />
    <meta property="og:title" content="{{ config('app.name') }} - Nosotros" />
    <meta property="og:description" content="{{ config('app.name') }} - Nosotros" />
    <meta name="description" content="{{ config('app.name') }} - Nosotros" />
    <meta name="keywords" content="{{ config('app.name') }}, Nosotros" />
    <meta property="og:url" content="{{ route('ecommerce.about.index') }}" />
    <meta name="twitter:description" content="{{ config('app.name') }} - Nosotros" />
    <meta name="twitter:title" content="{{ config('app.name') }} - Nosotros" />
@endsection

@section('body-class') class="about-us" @endsection

@section('content')
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ __('About us') }}</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-10 pb-8">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a></li>
                <li>{{ __('About us') }}</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <section class="introduce mb-10 pb-10">
                <h2 class="title title-center">
                    {{ __('We are Devoted Marketing') }}<br>
                    {{ __('Consultants Helping Your Business Grow') }}
                </h2>
                <p class=" mx-auto text-center">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    labore et dolore magna aliqua. Venenatis tellu metus
                </p>
                <figure class="br-lg">
                    <img src="https://images.pexels.com/photos/4050345/pexels-photo-4050345.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Banner"
                        width="1240" height="540" style="background-color: #D0C1AE;" />
                </figure>
            </section>

            <section class="customer-service mb-7">
                <div class="row align-items-center">
                    <div class="col-md-6 pr-lg-8 mb-8">
                        <h2 class="title text-left">{{ __('About us') }}</h2>
                        <div class="accordion accordion-simple accordion-plus">
                            <div class="card border-no">
                                <div class="card-header">
                                    <a href="#collapse3-1" class="expand">{{ __('Mission') }}</a>
                                </div>
                                <div class="card-body collapsed" id="collapse3-1">
                                    <p class="mb-0">
                                        {{ $about->mission }}
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse3-2" class="expand">{{ __('Vision') }}</a>
                                </div>
                                <div class="card-body collapsed" id="collapse3-2">
                                    <p class="mb-0">
                                        {{ $about->vision }}
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse3-3" class="expand">{{ __('Values') }}</a>
                                </div>
                                <div class="card-body collapsed" id="collapse3-3">
                                    <p class="mb-0">
                                        {{ $about->values }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg">
                            <img src="https://images.pexels.com/photos/618079/pexels-photo-618079.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Banner"
                                width="610" height="500" style="background-color: #CECECC;" />
                        </figure>
                    </div>
                </div>
            </section>

            <section class="count-section mb-10 pb-5">
                <div class="owl-carousel owl-theme row cols-lg-3 cols-md-2 cols-1" data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '768': {
                            'items': 2
                        },
                        '992': {
                            'items': 3
                        }
                    }
                }">
                    <div class="counter-wrap">
                        <div class="counter text-center">
                            <span class="count-to" data-to="{{ $productsCount }}">0</span>
                            {{-- <span>+</span> --}}
                            <h4 class="title title-center">{{ __('Products for Sale') }}</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="counter-wrap">
                        <div class="counter text-center">
                            {{-- <span>$</span> --}}
                            <span class="count-to" data-to="2">0</span>
                            {{-- <span>+</span> --}}
                            <h4 class="title title-center">{{ __('Branch offices') }}</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="counter-wrap">
                        <div class="counter text-center">
                            <span class="count-to" data-to="{{ $productBrandsCount }}">0</span>
                            {{-- <span>+</span> --}}
                            <h4 class="title title-center">{{ __('Brands') }}</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="boost-section pt-10 pb-10">
            <div class="container mt-10 mb-9">
                <div class="row align-items-center mb-10">
                    <div class="col-md-6 mb-8">
                        <figure class="br-lg">
                            <img src="https://images.pexels.com/photos/4050388/pexels-photo-4050388.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Banner"
                                width="610" height="450" style="background-color: #9E9DA2;" />
                        </figure>
                    </div>
                    <div class="col-md-6 pl-lg-8 mb-8">
                        <h4 class="title text-left">
                            {{ __('We Boost Our Clients’ Bottom Line by Optimizing Their Growth Potential') }}
                        </h4>
                        <p class="mb-6">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora et numquam corporis molestiae autem laudantium ea commodi iste tenetur libero rerum eveniet, quas fuga temporibus dolorum labore praesentium dolore nostrum?
                        </p>
                        <a href="#" class="btn btn-dark btn-rounded">{{ __('Visit our store') }}</a>
                    </div>
                </div>

                <div class="awards-wrapper">
                    <h4 class="title title-center font-weight-bold mb-10 pb-1 ls-25">{{ __('Partners') }}</h4>
                    <div class="owl-carousel owl-theme row cols-xl-4 cols-lg-3 cols-md-2 cols-1" data-owl-options="{
                        'nav': false,
                        'dots': true,
                        'margin': 20,
                        'responsive': {
                            '0': {
                                'items': 1
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
                        @foreach ($partners as $partner)
                            <div class="image-box-wrapper">
                                <div class="image-box text-center">
                                    <figure>
                                        <img src="{{ $partner->imagePreview() }}" alt="{{ $partner->name }}" width="109" height="105" />
                                    </figure>
                                    <p>{{ $partner->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/ecommerce/vendor/jquery.count-to/jquery.count-to.min.js') }}"></script>
@endsection
