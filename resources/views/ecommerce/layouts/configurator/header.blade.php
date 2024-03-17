<!-- Start of Header -->
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                @include('ecommerce.components.alert-impersonate')
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    <!-- End of Header Middle -->
    <div class="header-bottom py-1 d-flex">
        <div class="container-fluid">
            <div class="inner-wrap">
                <div class="header-left flex-1">
                    <a href="{{ route('ecommerce.home.index') }}"><img width="150" src="{{ asset(config('app.logo_white')) }}" alt="{{ config('app.name') }}"></a>
                </div>
                <div class="header-right">
                    <div class="dropdown cart-dropdown" style="margin-right: 1rem;">
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
    </div>
</header>
<!-- End of Header -->
