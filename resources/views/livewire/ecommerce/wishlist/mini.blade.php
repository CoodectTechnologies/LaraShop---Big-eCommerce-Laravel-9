<div>
    <a
        wire:click.prevent="store"
        wire:target="store"
        wire:loading.class="load-more-overlay loading"
        wire:loading.disabled
        class="btn-product-icon"
        href="#" >
        <span></span>
        @if ($isFavorite)
            <i class="fa fa-heart text-danger fa-1x mt-2"></i>
        @else
            <i class="fa fa-heart fa-1x mt-2"></i>
        @endif
    </a>
</div>
