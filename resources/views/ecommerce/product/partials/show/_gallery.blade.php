<div class="product-gallery product-gallery-sticky">
    <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
        @forelse($gallery as $image)
            <figure class="product-image">
                <img src="{{ $image->imagePreview() }}"
                    data-zoom-image="{{ $image->imagePreview() }}"
                    alt="{{ $product->name }}" width="800" height="900">
            </figure>
        @empty
            <figure class="product-image">
                <img src="{{ asset('assets/admin/media/svg/files/blank-image.svg') }}"
                    data-zoom-image="{{ asset('assets/admin/media/svg/files/blank-image.svg') }}"
                    alt="Sin imagen" width="800" height="900">
            </figure>
        @endforelse
    </div>
    <div class="product-thumbs-wrap">
        <div class="product-thumbs row cols-4 gutter-sm">
            @if(count($gallery) > 2)
                @foreach ($gallery as $image)
                    <div class="product-thumb {{ $loop->iteration == 0 ? 'active' : '' }}">
                        <img src="{{ $image->imagePreview() }}" alt="{{ $product->name }}" width="800" height="900">
                    </div>
                @endforeach
            @endif
        </div>
        <button class="thumb-up disabled">
            <i class="w-icon-angle-left"></i>
        </button>
        <button class="thumb-down disabled">
            <i class="w-icon-angle-right"></i>
        </button>
    </div>
</div>
