<div>
    <ul class="mobile-menu">
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('ecommerce.product.index', ['category' => $category->slug]) }}">
                    {{ $category->name }}
                </a>
                @if (isset($category->childrens) && count($category->childrens))
                    @include('ecommerce.layouts.menu-mobile.partials._category', ['category' => $category])
                @endif
            </li>
        @endforeach
    </ul>
</div>
