<?php

namespace App\Http\Livewire\Ecommerce\Layouts;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use Livewire\Component;

class Cart extends Component
{
    protected $listeners = ['render'];

    public function render(){
        return view('livewire.ecommerce.layouts.cart');
    }
    public function removeProduct($rowId, $productId){ //Dont remove $productId
        CartController::destroy($rowId);
    }
}
