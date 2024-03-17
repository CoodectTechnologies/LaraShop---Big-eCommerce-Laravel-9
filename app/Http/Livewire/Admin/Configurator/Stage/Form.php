<?php

namespace App\Http\Livewire\Admin\Configurator\Stage;

use App\Models\ConfiguratorStage;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Form extends Component
{
    public $configuratorStage;
    public $method;
    public $productCategoryFilter = [];
    public $productsArray = [];
    public $order;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    public function rules(){
        return [
            'configuratorStage.name.'.translatable() => 'required',
            'configuratorStage.order' => 'nullable',
            'configuratorStage.type' => 'required',
            'configuratorStage.optional' => 'required',
            'productsArray' => 'required',
        ];
    }
    public function mount(ConfiguratorStage $configuratorStage, $method){
        $this->configuratorStage = $configuratorStage;
        $this->method = $method;
        $this->configuratorStage->type = $this->configuratorStage->type ?? ConfiguratorStage::TYPE_COMPONENT;
        $this->configuratorStage->optional = $this->configuratorStage->optional ?? 0;
        $this->order = $configuratorStage->order;
        $this->loadProducts();
        $this->loadLastOrder();
    }
    public function render(){
        $productCategories = $this->getProductCategories();
        $products = $this->getProducts();
        return view('livewire.admin.configurator.stage.form', compact('productCategories', 'products'));
    }
    public function store(){
        $this->validate();
        $this->configuratorStage->save();
        $this->saveProducts();
        $this->reOrder();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.configurator.stage.index');
    }
    public function update(){
        $this->validate();
        $this->configuratorStage->update();
        $this->saveProducts();
        $this->reOrder();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.configurator.stage.index');
    }
    public function selectAllProducts(){
        $products = $this->getProducts();
        foreach($products as $product):
            array_push($this->productsArray, $product->id);
        endforeach;
    }
    private function getProductCategories(){
        return ProductCategory::with(['allChildrens' => function($query){
            $query->orderBy('name', 'asc');
        }])->whereNull('parent_id')->orderBy('name', 'asc')->get();
    }
    private function getProducts(){
        $products = Product::orderBy('name');
        if(count($this->productCategoryFilter) && !in_array('0', $this->productCategoryFilter)):
            $products = $products->whereHas('productCategories', function($query){
                $query->whereIn('product_category_id', $this->productCategoryFilter);
            });
        endif;
        if($this->search):
            $products = $products->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $products = $products->get();
        return $products;
    }
    public function getTypes(){
        return [ConfiguratorStage::TYPE_COMPONENT, ConfiguratorStage::TYPE_ADDON];
    }
    private function saveProducts(){
        if(count($this->productsArray)):
           $this->configuratorStage->products()->sync($this->productsArray);
        endif;
    }
    private function loadProducts(){
        $this->productsArray = $this->configuratorStage->products()->pluck('product_id')->toArray();
    }
    private function reOrder(){
        if($this->order != $this->configuratorStage->order):
            $reOrder = ConfiguratorStage::where('order', $this->configuratorStage->order)->where('type', $this->configuratorStage->type)->where('id', '<>', $this->configuratorStage->id)->first();
            if($reOrder):
                $configuratorStagesToOrder = ConfiguratorStage::where('order', '>=', $this->configuratorStage->order);
                if($this->configuratorStage->exists):
                    $configuratorStagesToOrder = $configuratorStagesToOrder->where('id', '<>', $this->configuratorStage->id)->where('type', $this->configuratorStage->type);
                endif;
                $configuratorStagesToOrder->increment('order');
            endif;
        endif;
    }
    public function loadLastOrder(){
        if($this->configuratorStage->type && !$this->configuratorStage->exists):
            $lastOrder = ConfiguratorStage::latest('order');
            if($this->configuratorStage->type):
                $lastOrder = $lastOrder->where('type', $this->configuratorStage->type);
            endif;
            $lastOrder = $lastOrder->first();
            if($lastOrder):
                $this->configuratorStage->order = ($lastOrder->order + 1);
            else:
                $this->configuratorStage->order = 1;
            endif;
        endif;
    }
}
