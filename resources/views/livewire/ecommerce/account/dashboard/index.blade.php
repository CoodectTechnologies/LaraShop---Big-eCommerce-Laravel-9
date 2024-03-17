<!-- Start of PageContent -->
<div class="page-content pt-2">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">

            {{-- @include('ecommerce.account.menu.index') --}}

            <div class="container">
                <div class="tab-pane active in" id="account-dashboard">
                    <div class="row mb-5">
                        <h4 class="title title-underline ls-25 font-weight-bold">
                            {{ __('Dashboard') }}
                        </h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6 mb-4">
                            <a href="{{ route('ecommerce.account.order.index') }}" class="link-to-tab">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <p class="text-uppercase mb-0">{{ __('Orders') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6 mb-4">
                            <a href="{{ route('ecommerce.account.product-digital.index') }}" class="link-to-tab">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon icon-download">
                                        <i class="w-icon-download"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <p class="text-uppercase mb-0">{{ __('My products digitals') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6 mb-4">
                            <a href="{{ route('ecommerce.account.shipping-address.index') }}" class="link-to-tab">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon icon-address">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <p class="text-uppercase mb-0">{{ __('Shipping address') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6 mb-4">
                            <a href="{{ route('ecommerce.account.billing-address.index') }}" class="link-to-tab">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon icon-address">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <p class="text-uppercase mb-0">{{ __('Billing address') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6 mb-4">
                            <a href="{{ route('ecommerce.account.profile.index') }}" class="link-to-tab">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon icon-account">
                                        <i class="w-icon-user"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <p class="text-uppercase mb-0">{{ __('Profile') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6 mb-4">
                            <a href="{{ route('ecommerce.wishlist.index') }}" class="link-to-tab">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon icon-wishlist">
                                        <i class="w-icon-heart"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <p class="text-uppercase mb-0">{{ __('Wishlist') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 col-6 mb-4">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon icon-logout">
                                        <i class="w-icon-logout"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <p class="text-uppercase mb-0">{{ __('Logout') }}</p>
                                    </div>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End of PageContent -->
