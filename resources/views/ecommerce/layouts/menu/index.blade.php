<nav class="main-nav">
    <ul class="menu">
        @if(Route::has('ecommerce.home.index'))
            <li class="{{ active('ecommerce.home.index') }}">
                <a href="{{ route('ecommerce.home.index') }}">{{ __('Home') }}</a>
            </li>
        @endif
        @if(Route::has('ecommerce.product.index'))
            <li class="{{ active('ecommerce.product.index') }}">
                <a href="{{ route('ecommerce.product.index') }}">{{ __('Products') }}</a>
            </li>
        @endif
        @if(Route::has('ecommerce.configurator.index') && config('configurator.active'))
            <li class="{{ active('ecommerce.configurator.index') }}">
                <a href="{{ route('ecommerce.configurator.index') }}">{{ __('Build your pc') }}</a>
            </li>
        @endif
        @if(Route::has('ecommerce.about.index'))
            <li class="{{ active('ecommerce.about.index') }}">
                <a href="{{ route('ecommerce.about.index') }}">{{ __('About') }}</a>
            </li>
        @endif
        @if(Route::has('ecommerce.blog.index'))
            <li class="{{ active('ecommerce.blog.index') }}">
                <a href="{{ route('ecommerce.blog.index') }}">{{ __('Blog') }}</a>
            </li>
        @endif
        @if(Route::has('ecommerce.gallery.index'))
            <li class="{{ active('ecommerce.gallery.index') }}">
                <a href="{{ route('ecommerce.gallery.index') }}">{{ __('Gallery') }}</a>
            </li>
        @endif
        @if(Route::has('ecommerce.contact.index'))
            <li class="{{ active('ecommerce.contact.index') }}">
                <a href="{{ route('ecommerce.contact.index') }}">{{ __('Contact') }}</a>
            </li>
        @endif
    </ul>
</nav>
