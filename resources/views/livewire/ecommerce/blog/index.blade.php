<div>
    <!-- Start of Page Content -->
    <div class="page-content mb-10 pb-2">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content">
                    @forelse ($posts as $post)
                        <article class="post post-list post-listing mb-md-10 mb-6 pb-2 overlay-zoom mb-4">
                            <figure class="post-media br-sm">
                                <a href="{{ route('ecommerce.blog.show', $post) }}">
                                    <img src="{{ $post->imagePreview() }}" width="930" height="500"  alt="{{ $post->name }}">
                                </a>
                            </figure>
                            <div class="post-details">
                                <div class="post-cats text-primary">
                                    @foreach ($post->blogCategories as $blogCategory)
                                        <a href="{{ route('ecommerce.blog.index', ['category' => $blogCategory->slug]) }}">{{ $blogCategory->name }}</a>
                                    @endforeach
                                </div>
                                <h4 class="post-title">
                                    <a href="{{ route('ecommerce.blog.show', $post) }}">
                                        {{ $post->name }}
                                    </a>
                                </h4>
                                <div class="post-content">
                                    <p>
                                        {{ $post->fragment }}
                                    </p>
                                    <a href="{{ route('ecommerce.blog.show', $post) }}" class="btn btn-link btn-primary">({{ __('Read more') }})</a>
                                </div>
                                <div class="post-meta">
                                    @if ($post->user)
                                        by <a class="post-author">{{ $post->user->name }}</a>  -
                                    @endif
                                    <a class="post-date">{{ $post->dateToString() }}</a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="alert alert-primary alert-simple alert-inline">
                            <h4 class="alert-title">{{ __('Without results') }}</h4>
                            {{ $search }}
                        </div>
                    @endforelse
                    <ul class="pagination justify-content-center">
                        {{ $posts->links() }}
                    </ul>
                </div>
                <!-- End of Main Content -->
                @livewire('ecommerce.blog.sidebar')
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</div>
