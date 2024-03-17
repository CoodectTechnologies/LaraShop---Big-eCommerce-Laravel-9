<?php

namespace App\Http\Livewire\Ecommerce\Compare;

use App\Http\Controllers\Ecommerce\Compare\CompareController;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class Index extends Component
{
    public function render(){
        $compares = Cart::instance('compare')->content();
        return view('livewire.ecommerce.compare.index', compact('compares'));
    }
    public function delete($rowId){
        CompareController::delete($rowId);
        $this->emitTo('ecommerce.layouts.compare', 'render');
    }
    public function storeInCart($productId){
        $product = Product::find($productId);
        CompareController::storeInCart($product);
        $this->emitTo('ecommerce.layouts.cart', 'render');
    }
}
