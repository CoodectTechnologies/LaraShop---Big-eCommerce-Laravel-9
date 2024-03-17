<div class="dropdown cart-dropdown mr-3 d-none d-lg-block">
    <div class="cart-overlay"></div>
    <a href="{{ route('ecommerce.compare.index') }}" class="cart-toggle label-down link">
        <i class="w-icon-compare">
            <span class="cart-count">{{ Cart::instance('compare')->count() }}</span>
        </i>
        <span class="cart-label">{{ __('Compare') }}</span>
    </a>
</div>
