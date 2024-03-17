<div>
    <div class="mb-10 pb-1">
        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                @include('ecommerce.components.alert')
                <div class="row gutter-lg pb-5">
                    <div class="main-content">
                        <div class="product product-single row">
                            <div class="col-md-6 mb-6">
                                @include('ecommerce.product.partials.show._gallery')
                            </div>
                            <div class="col-md-6 mb-4 mb-md-6">
                                @include('ecommerce.product.partials.show._product')
                            </div>
                        </div>
                        <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                @include('ecommerce.product.partials.show._menu')
                            </ul>
                            <div wire:ignore.self class="tab-content">
                                <div wire:ignore.self class="tab-pane active" id="product-tab-description">
                                    {!! $product->description !!}
                                </div>
                                <div wire:ignore.self class="tab-pane" id="product-tab-video">
                                    {!! $product->iframe_url !!}
                                </div>
                                <div wire:ignore.self class="tab-pane" id="product-tab-reviews">
                                    @livewire('ecommerce.comment.form', ['model' => $product])
                                    @livewire('ecommerce.comment.index', ['model' => $product])
                                </div>
                            </div>
                        </div>
                        <div wire:ignore>
                            @include('ecommerce.product.partials.show._related_product')
                        </div>
                    </div>
                    @include('ecommerce.product.partials.show._sidebar')
                </div>
            </div>
        </div>
        <!-- End of Page Content -->


        <!-- Root element of PhotoSwipe. Must have class pswp -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

            <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>

            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">

                <!-- Container that holds slides.
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">

                    <div class="pswp__top-bar">

                        <!--  Controls are self-explanatory. Order can be changed. -->

                        <div class="pswp__counter"></div>

                        <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>

                        <div class="pswp__preloader">
                            <div class="loading-spin"></div>
                        </div>
                    </div>

                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>

                    <button class="pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
                    <button class="pswp__button--arrow--right" aria-label="Next (arrow right)"></button>

                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PhotoSwipe -->
    </div>
    @push('footer')
        <script>
            window.initJS = () => {
                const owl = $('.owl-carousel');
                $(owl).trigger('destroy.owl.carousel');
                $(owl).html($(owl).find('.owl-stage-outer').html()).removeClass('owl-loaded'); // Destroy carousel instance part 2
                Coodect.reloadCarouselProductSingle();
                Coodect.productSingle('.product-single');
            }
            Livewire.on('renderJs', function() {
                initJS();
            });
        </script>
    @endpush
</div>
