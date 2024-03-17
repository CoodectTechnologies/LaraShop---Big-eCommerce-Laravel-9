<div>
    <a
        wire:click.prevent="store"
        wire:target="store"
        wire:loading.class="load-more-overlay loading"
        wire:loading.disabled
        class="btn-product-icon btn-cart w-icon-cart"
        href="#"
        title="{{ __('Add to cart') }}">
        <span></span>
    </a>
</div>
