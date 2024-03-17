<?php

namespace App\Http\Livewire\Ecommerce\Wishlist;

use App\Http\Controllers\Ecommerce\Wishlist\WishlistController;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Index extends Component
{
    public function render(){
        $wishlists = Cart::instance('wishlist')->content();
        return view('livewire.ecommerce.wishlist.index', compact('wishlists'));
    }
    public function delete($rowId){
        WishlistController::delete($rowId);
        $this->emitTo('ecommerce.layouts.wishlist', 'render');
    }
    public function storeInCart($productId){
        $product = Product::find($productId);
        WishlistController::storeInCart($product);
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
}
