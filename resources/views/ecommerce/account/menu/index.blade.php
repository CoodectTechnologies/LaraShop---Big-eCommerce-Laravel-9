<aside wire:ignore="" class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
    <div class="sidebar-overlay"></div>
    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
    <div class="sidebar-content scrollable">
        <div class="sticky-sidebar" style="border-bottom: 0px none rgb(102, 102, 102);">
            <div class="widget widget-icon-box mb-6">
                <ul class="mb-6" style="list-style: none;" role="tablist">
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.account.dashboard.index') }}'">
                        <a href="#" class="nav-link {{ active('ecommerce.account.dashboard.index') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.account.order.index') }}'">
                        <a href="#" class="nav-link {{ active('ecommerce.account.order.index') }}">{{ __('Orders') }}</a>
                    </li>
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.account.product-digital.index') }}'">
                        <a href="#" class="nav-link {{ active('ecommerce.account.product-digital.index') }}">{{ __('My products digitals') }}</a>
                    </li>
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.account.shipping-address.index') }}'">
                        <a href="#" class="nav-link {{ active('ecommerce.account.shipping-address.index') }}">{{ __('Shipping address') }}</a>
                    </li>
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.account.billing-address.index') }}'">
                        <a href="#" class="nav-link {{ active('ecommerce.account.billing-address.index') }}" class="nav-link {{ active('ecommerce.account.billing-address.index') }}">{{ __('Billing address') }}</a>
                    </li>
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.account.profile.index') }}'">
                        <a href="#" class="nav-link {{ active('ecommerce.account.profile.index') }}" class="nav-link {{ active('ecommerce.account.profile.index') }}">{{ __('Profile') }}</a>
                    </li>
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.account.profile.password') }}'">
                        <a href="#" class="nav-link {{ active('ecommerce.account.profile.password') }}" class="nav-link {{ active('ecommerce.account.profile.password') }}">{{ __('Password') }}</a>
                    </li>
                    <li class="link-item" onclick="window.location='{{ route('ecommerce.wishlist.index') }}'">
                        <a href="#" class="nav-link">{{ __('Wishlist') }}</a>
                    </li>
                    <li class="link-item">
                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="nav-link">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>

