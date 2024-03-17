<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Similar;

use App\Models\Product;
use App\Models\ProductSimilar;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $product;
    public $productSimilarIds;
    public $search;

    protected function rules(){
        return [
            'productSimilarIds' => 'required|array|min:1',
        ];
    }
    public function mount(Product $product, $method){
        $this->product = $product;
        $this->productSimilarIds = $this->product->productSimilars()->pluck('product_similar_id');
        $this->method = $method;
    }
    public function render(){
        $products = Product::where('id', '<>', $this->product->id)->orderByDesc('name');
        if($this->search):
            $products = $products->where(function($query){
                $query->orWhere('name', 'LIKE', "%{$this->search}%")
                ->orWhere('sku', 'LIKE', "%{$this->search}%")
                ->orWhere('detail', 'LIKE', "%{$this->search}%")
                ->orWhere('search_advanced', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%");
            });
        endif;
        $products = $products->get();
        return view('livewire.admin.catalog.product.similar.form', compact('products'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $productSimilarIdsFormat = $this->formatData();
        $this->product->productSimilars()->delete();
        ProductSimilar::insert($productSimilarIdsFormat);
        $this->emit('alert', 'success', 'Producto similares relacionados al producto con éxito');
        $this->emit('render');
    }
    private function formatData(){
        $productSimilarIds = [];
        foreach($this->productSimilarIds as $productSimilarId):
            $productSimilarIds[] = [
                'product_id' => $this->product->id,
                'product_similar_id' => $productSimilarId,
            ];
        endforeach;
        return $productSimilarIds;
    }
}
