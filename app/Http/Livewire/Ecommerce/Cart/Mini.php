<?php

namespace App\Http\Livewire\Ecommerce\Cart;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Models\Product;
use Livewire\Component;

class Mini extends Component
{
    public $product;

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        return view('livewire.ecommerce.cart.mini');
    }
    public function store(){
        $type = $this->product->getType();
        if($this->product->getType() == Product::TYPE_PHYSICAL_AND_DIGITAL):
            $type = Product::TYPE_PHYSICAL;
        endif;
        $options = [
            'size' => [
                'id' => null,
                'name' => null,
            ],
            'color' => [
                'id' => null,
                'name' => null,
            ],
            'image' => $this->product->imagePreview(),
            'price' => $this->product->getPriceFinal(),
            'type' => $type
        ];
        $addCart = CartController::store($this->product, 1, $this->product->getPriceFinal(), $options);
        if($addCart === true):
            $this->emitTo('ecommerce.layouts.cart', 'render');
            $this->emit(
                'notifyAddCart',
                $this->product->name,
                route('ecommerce.product.show', $this->product),
                $this->product->imagePreview()
            );
        endif;
    }
}
