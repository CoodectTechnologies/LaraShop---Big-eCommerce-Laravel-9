<!-- Start of Header -->
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                @if (!session()->has('impersonated_by'))
                    <p class="welcome-msg mr-5">¡{{ __('Welcome to') }} {{ config('app.name') }}!</p>
                @endif
                @include('ecommerce.components.alert-impersonate')
            </div>
            <div class="header-right pr-0">
                <div class="dropdown">
                    <a href="#currency"><span class="text-uppercase">{{ session()->get('currency') }}</span></a>
                    <div wire:ignore.self class="dropdown-box">
                        @foreach (currencies() as $currency)
                            <a href="{{ route('ecommerce.currency', $currency->code) }}">{{ $currency->code }}</a>
                        @endforeach
                    </div>
                </div>
                @if(count(languages()) && language())
                    <!-- End of DropDown Menu -->
                    <div class="dropdown">
                        <a href="#language">
                            <img src="{{ languages()[language()]['flag'] }}" alt="{{ language() }}" width="14" height="8" class="dropdown-image" />
                            <span class="text-uppercase">{{ language() }}</span>
                        </a>
                        <div class="dropdown-box">
                            @foreach (languages() as $locale => $language)
                                <a href="{{ route('ecommerce.language', ['language' => $locale]) }}">
                                    <img src="{{ $language['flag'] }}" alt="{{ $language['name'] }}" width="14" height="8" class="dropdown-image" />
                                    {{ Str::upper($locale) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- End of Dropdown Menu -->
                @endif
                <span class="divider d-lg-show"></span>
                {{-- <a href="blog.html" class="d-lg-show">{{ __('Blog') }}</a> --}}
                <a href="{{ route('ecommerce.contact.index') }}" class="d-lg-show">{{ __('Contact us') }}</a>
                @auth
                    <a href="{{ route('ecommerce.account.dashboard.index') }}" class="d-lg-show">{{ __('My account') }}</a>
                    <span class="delimiter d-lg-show">/</span>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="ml-0 d-lg-show login">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="d-lg-show login sign-in">
                        <i class="w-icon-account"></i>{{ __('Sign in') }}
                    </a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="{{ route('register') }}" class="ml-0 d-lg-show login register">{{ __('Register') }}</a>
                @endguest
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                </a>
                <a href="{{ route('ecommerce.home.index') }}" class="logo ml-lg-0">
                    <img src="{{ asset(config('app.logo_white')) }}" alt="logo" width="200" />
                </a>
                @livewire('ecommerce.layouts.search')
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:{{ config('contact.phone') }}" class="w-icon-call"></a>
                    <div class="call-info d-xl-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            {{-- <a href="mailto:{{ config('contact.email') }}" class="text-capitalize">{{ __('Email') }} </a> o:</h4> --}}
                        <a href="tel:{{ config('contact.phone') }}" class="phone-number font-weight-bolder ls-50">{{ config('contact.phone') }}</a>
                    </div>
                </div>
                <div class="dropdown cart-dropdown d-block d-lg-none" style="margin-right: 1rem;">
                    <div class="cart-overlay"></div>
                    <a href="{{ route('ecommerce.account.dashboard.index') }}" class="cart-toggle label-down link">
                        <i class="w-icon-user"></i>
                        <span class="cart-label">{{ __('Profile') }}</span>
                    </a>
                </div>
                @livewire('ecommerce.layouts.wishlist')
                @livewire('ecommerce.layouts.compare')
                @livewire('ecommerce.layouts.cart')
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->
    <div class="header-bottom sticky-content fix-top sticky-header">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left flex-1">
                    <div class="dropdown category-dropdown has-border" data-visible="true">
                        <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true" data-display="static"
                            title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>{{ __('Search category') }}</span>
                        </a>
                        @include('ecommerce.layouts.menu.category')
                    </div>
                    @include('ecommerce.layouts.menu.index')
                </div>
                <div class="header-right">
                    <a href="{{ route('ecommerce.track-order.index') }}" class="d-xl-show">
                        <i class="w-icon-map-marker mr-1"></i>
                        {{ __('Track order') }}
                    </a>
                    <a href="{{ route('ecommerce.product.index', ['promotions' => 'ofertas']) }}" class="">
                        <i class="w-icon-sale"></i>
                        {{ __('Promotions') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End of Header -->
