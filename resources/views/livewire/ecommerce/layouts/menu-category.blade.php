<div>
    <div>
        <div class="dropdown-box">
            <ul class="menu vertical-menu category-menu">
                @foreach ($categories as $category)
                    @if ($loop->iteration <= 10)
                        <li>
                            <a href="{{ route('ecommerce.product.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            @if (isset($category->childrens) && count($category->childrens))
                                @include('ecommerce.layouts.menu.partials._category', ['category' => $category])
                            @endif
                        </li>
                    @else
                        <li>
                            <a href="{{ route('ecommerce.category.index') }}" class="font-weight-bold text-primary text-uppercase ls-25">
                                {{ __('View all categories') }}<i class="w-icon-angle-right"></i>
                            </a>
                        </li>
                        @break
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

</div>
