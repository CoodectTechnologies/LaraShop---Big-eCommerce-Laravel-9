<?php

namespace App\Http\Livewire\Ecommerce\Wishlist;

use App\Http\Controllers\Ecommerce\Wishlist\WishlistController;
use App\Models\Product;
use Livewire\Component;

class Mini extends Component
{
    public $product;
    public $isFavorite;

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        $this->isFavorite();
        return view('livewire.ecommerce.wishlist.mini');
    }
    public function isFavorite(){
        $this->isFavorite = WishlistController::existInWishlist($this->product->id);
    }
    public function store(){
        WishlistController::store($this->product);
        $this->emitTo('ecommerce.layouts.wishlist', 'render');
    }
}
