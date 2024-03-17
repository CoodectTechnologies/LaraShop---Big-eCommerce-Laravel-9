<div class="sidebar right-sidebar blog-sidebar sidebar-fixed sticky-sidebar-wrapper">
    <aside >
        <div class="sidebar-overlay">
            <a href="#" class="sidebar-close">
                <i class="close-icon"></i>
            </a>
        </div>
        <a href="#" class="sidebar-toggle">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div class="sidebar-content">
            <div class="sticky-sidebar">
                <div class="widget widget-search-form">
                    <div class="widget-body">
                        <form action="{{ route('ecommerce.blog.index') }}" method="GET" class="input-wrapper input-wrapper-inline">
                            <input type="text" name="search" class="form-control" placeholder="{{ __('Search in blog') }}" autocomplete="off" required>
                            <button class="btn btn-search"><i class="w-icon-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- End of Widget search form -->
                <div class="widget widget-categories">
                    <h3 class="widget-title bb-no mb-0">{{ __('Categories') }}</h3>
                    <ul class="widget-body filter-items search-ul">
                        @foreach ($categories as $category)
                            <li><a href="{{ route('ecommerce.blog.index', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- End of Widget posts -->
                <div class="widget widget-tags">
                    <h3 class="widget-title bb-no">{{ __('Tags') }}</h3>
                    <div class="widget-body tags">
                        @foreach ($tags as $tag)
                            <a href="{{ route('ecommerce.blog.index', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
