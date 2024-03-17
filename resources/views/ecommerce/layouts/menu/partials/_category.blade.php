<ul>
    @foreach ($category->childrens as $categoryChildren)
        <li>
            <a href="{{ route('ecommerce.product.index', ['category' => $categoryChildren->slug]) }}">{{ $categoryChildren->name }}</a>
            @if (isset($categoryChildren->childrens) && count($categoryChildren->childrens))
                @include('ecommerce.layouts.menu.partials._category', ['category' => $categoryChildren])
            @endif
        </li>
    @endforeach
</ul>


