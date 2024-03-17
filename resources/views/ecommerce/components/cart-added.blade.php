<script>
    $(document).ready(function(){
        Livewire.on('notifyAddCart', (name, url, image) => {
            Coodect.Minipopup.open({
                productClass: ' product-cart',
                name: name,
                nameLink: url,
                imageSrc: image,
                imageLink: url,
                message: '<p>{{ __("Has been added to cart") }}:</p>',
                actionTemplate: '<a href="{{ route("ecommerce.cart.index") }}" class="btn btn-rounded btn-sm">{{ __("View Cart") }}</a><a href="{{ route("ecommerce.checkout.index") }}" class="btn btn-dark btn-rounded btn-sm">{{ __("Checkout") }}</a>'
            });
        });
    });
</script>
