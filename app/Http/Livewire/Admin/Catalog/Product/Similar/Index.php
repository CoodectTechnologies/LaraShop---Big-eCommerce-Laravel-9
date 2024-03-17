<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Similar;

use App\Models\Product;
use App\Models\ProductSimilar;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public $product;

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        $similars = $this->product->productSimilars()->get();
        return view('livewire.admin.catalog.product.similar.index', compact('similars'));
    }
    public function destroy(ProductSimilar $productSimilar){
        try{
            $productSimilar->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
