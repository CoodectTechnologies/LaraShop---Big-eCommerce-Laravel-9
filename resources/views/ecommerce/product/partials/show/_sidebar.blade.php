<!-- End of Main Content -->
<aside wire:ignore class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
    <div class="sidebar-overlay"></div>
    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
    <div class="sidebar-content scrollable">
        <div class="sticky-sidebar">
            <div class="widget widget-icon-box mb-6">
                <div class="icon-box icon-box-side">
                    <span class="icon-box-icon text-dark">
                        <i class="w-icon-truck"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">{{ __('Free shipping & returns') }}</h4>
                        <p>{{ __('For all orders') }}</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side">
                    <span class="icon-box-icon text-dark">
                        <i class="w-icon-bag"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">{{ __('Secure payment') }}</h4>
                        <p>{{ __('We ensure secure payment') }}</p>
                    </div>
                </div>
                <div class="icon-box icon-box-side">
                    <span class="icon-box-icon text-dark">
                        <i class="w-icon-money"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">{{ __('Money back guarantee') }}</h4>
                        <p>{{ __('Any back within 30 days') }}</p>
                    </div>
                </div>
            </div>
            <!-- End of Widget Icon Box -->

            {{-- <div class="widget widget-banner mb-9">
                <div class="banner banner-fixed br-sm">
                    <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fcoodect%2Fposts%2Fpfbid02EMhxgU4qVyBc9orifP3Yf2CdGQ1bpMMenH6bcxxdFLdXvBc2aXUzutjERrsChRFZl&show_text=true&width=500" width="500" height="674" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div> --}}
            <!-- End of Widget Banner -->

            <div class="widget widget-products">
                <div class="title-link-wrapper mb-2">
                    <h4 class="title title-link font-weight-bold">{{ __('Recently viewed') }}</h4>
                </div>
                @foreach ($productsViewRecents as $productViewRecent)
                    <div class="product product-widget">
                        <figure class="product-media">
                            <a href="{{ route('ecommerce.product.show', $productViewRecent) }}">
                                <img src="{{ $productViewRecent->imagePreview() }}" alt="{{ $productViewRecent->name }}"
                                    width="100" height="113" />
                            </a>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-name">
                                <a href="{{ route('ecommerce.product.show', $productViewRecent) }}">{{ $productViewRecent->name }}</a>
                            </h4>
                            <div class="ratings-container">
                                <div class="ratings-full">
                                    <span class="ratings" style="width: {{ $productViewRecent->getStarsPercentageAVG() }}%;"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <div class="product-price">{!! $productViewRecent->getPriceToString() !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</aside>
<!-- End of Sidebar -->
