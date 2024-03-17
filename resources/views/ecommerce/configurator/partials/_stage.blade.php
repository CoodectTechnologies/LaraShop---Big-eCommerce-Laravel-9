<div class="product product-widget">
    <figure class="product-media border-radius">
        <a href="#">
            @if ($product)
                <img class="border-radius" src="{{ $product->model->imagePreview() }}" alt="{{ $product->name }}" />
            @else
                <img class="border-radius" src="{{ $stage->imagePreview() }}" alt="{{ $stage->name }}" />
            @endif
        </a>
    </figure>
    <div class="product-details">
        <h4 class="product-name">
            <a class="overflow-2-lines">
                {{ $stage->name }}
            </a>
        </h4>
        @if(isset($errorsCompatibilities[$stage->id]))
            <div class="ratings-container overflow-2-lines bg-secondary p-2">
                {{ __('Select another product.') }}
            </div>
        @elseif($product)
            <div class="ratings-container overflow-2-lines">
                {{ $product->name }}
            </div>
        @endif
    </div>
</div>
