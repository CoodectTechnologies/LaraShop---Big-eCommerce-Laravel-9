<div>
    <!-- Start of Page Content -->
    <div class="page-content mb-8">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content post-single-content">
                    <div class="post post-grid post-single">
                        <figure class="post-media br-sm">
                            <img src="{{ $post->imagePreview() }}" alt="{{ $post->name }}" width="930"  height="500" />
                        </figure>
                        <div class="post-details">
                            <div class="post-meta">
                                @if ($post->user)
                                    by <a href="#" class="post-author">{{ $post->user->name }} -</a>
                                @endif
                                <a class="post-date">{{ $post->dateToString() }}</a>
                                <a class="post-comment"><i class="w-icon-comments"></i><span>{{ count($comments) }}</span>{{ __('Comments') }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Post -->
                    <blockquote class="text-center mb-8">
                        <i class="fas fa-quote-left"></i>
                        <h2 class="font-weight-bold text-dark mt-1 mb-2">
                            {{ $post->name }}
                        </h2>
                        <cite class="font-weight-normal text-dark">
                            @if ($post->user)
                                by <a href="#" class="post-author">{{ $post->user->name }}</a>
                            @endif
                        </cite>
                    </blockquote>
                    <!-- End Blockquote -->
                    <p class="mb-10">
                        {{ $post->fragment }}
                    </p>
                    <div>
                        {!! $post->body !!}
                    </div>
                    <div class="tags">
                        <label class="text-dark mr-2">{{ __('Tags') }}:</label>
                        @foreach ($post->blogTags as $tag)
                            <a href="{{ route('ecommerce.blog.index', ['tag' => $tag->slug]) }}" class="tag">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    <!-- End Tag -->
                    <div class="post-navigation">
                        <div class="nav nav-prev">
                            @if ($previous)
                                <a href="{{ route('ecommerce.blog.show', $previous) }}" class="align-items-start text-left">
                                    <span><i class="w-icon-long-arrow-left"></i>{{ __('Previous post') }}</span>
                                    <span class="nav-content mb-0 text-normal">{{ $previous->name }}</span>
                                </a>
                            @endif
                        </div>
                        <div class="nav nav-next">
                            @if ($next)
                                <a href="{{ route('ecommerce.blog.show', $next) }}" class="align-items-end text-right">
                                    <span>{{ __('Next post') }}<i class="w-icon-long-arrow-right"></i></span>
                                    <span class="nav-content mb-0 text-normal">{{ $next->name }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                    @if (count($postsRelated))
                        <!-- End Post Navigation -->
                        <h4 class="title title-lg font-weight-bold mt-10 pt-1 mb-5">{{ __('Related posts') }}</h4>
                        <div class="post-slider owl-carousel owl-theme owl-nav-top row cols-lg-3 cols-md-4 cols-sm-3 cols-xs-2 cols-1 pb-2" data-owl-options="{
                            'nav': true,
                            'dots': false,
                            'margin': 20,
                            'responsive': {
                                '0': {
                                    'items': 1
                                },
                                '576': {
                                    'items': 2
                                },
                                '768': {
                                    'items': 3
                                },
                                '992': {
                                    'items': 2
                                },
                                '1200': {
                                    'items': 3
                                }
                            }
                        }">
                            @foreach ($postsRelated as $postRelated)
                                <div class="post post-grid">
                                    <figure class="post-media br-sm">
                                        <a href="{{ route('ecommerce.blog.show', $postRelated) }}">
                                            <img src="{{ $postRelated->imagePreview() }}" alt="{{ $postRelated->name }}" width="296" height="190" style="background-color: #bcbcb4;" />
                                        </a>
                                    </figure>
                                    <div class="post-details text-center">
                                        <div class="post-meta">
                                            @if ($postRelated->user)
                                                by <a class="post-author">{{ $postRelated->user->name }} -</a>
                                            @endif
                                            <a class="post-date">{{ $postRelated->dateToString() }}</a>
                                        </div>
                                        <h4 class="post-title mb-3"><a href="{{ route('ecommerce.blog.show', $postRelated) }}">{{ $postRelated->name }}</a></h4>
                                        <a href="{{ route('ecommerce.blog.show', $postRelated) }}" class="btn btn-link btn-dark btn-underline font-weight-normal">{{ __('Read more') }}<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- End Related Posts -->
                    @endif

                    <div id="product-tab-reviews">
                        @livewire('ecommerce.comment.form', ['model' => $post], key('comment-form-'.$post->id))
                        @livewire('ecommerce.comment.index', ['model' => $post], key('comment-index-'.$post->id))
                    </div>


                </div>
                <!-- End of Main Content -->
                @livewire('ecommerce.blog.sidebar')
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</div>
