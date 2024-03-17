<?php

namespace App\Http\Livewire\Ecommerce\Compare;

use App\Http\Controllers\Ecommerce\Compare\CompareController;
use App\Models\Product;
use Livewire\Component;

class Mini extends Component
{
    public $product;

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        return view('livewire.ecommerce.compare.mini');
    }
    public function store(){
        CompareController::store($this->product);
        $this->emitTo('ecommerce.layouts.compare', 'render');
    }
}
