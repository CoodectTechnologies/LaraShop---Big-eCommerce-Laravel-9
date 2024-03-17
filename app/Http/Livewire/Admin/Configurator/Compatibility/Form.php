<?php

namespace App\Http\Livewire\Admin\Configurator\Compatibility;

use App\Models\ConfiguratorCompatibility;
use App\Models\ConfiguratorStage;
use App\Models\ConfiguratorStageProduct;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Form extends Component
{
    public $configuratorCompatibility;
    public $method;
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    public $configuratorStageId;
    public $configuratorStageIdTMP;
    public $configuratorStageProductIdTMP;
    public $productsArray = [];

    public function rules(){
        return [
            'configuratorCompatibility.configurator_stage_product_id' => 'required',
            'configuratorCompatibility.configurator_stage_id' => 'required',
            'productsArray' => 'required',
        ];
    }
    public function mount(ConfiguratorCompatibility $configuratorCompatibility, $method){
        $this->configuratorCompatibility = $configuratorCompatibility;
        $this->method = $method;
        $this->loadProducts();
    }
    public function render(){
        $configuratorStages = $this->getConfiguratorStages();
        $configuratorStageProducts = $this->getConfiguratorStagesProducts();
        $products = $this->getProducts();
        return view('livewire.admin.configurator.compatibility.form', compact('configuratorStages', 'configuratorStageProducts', 'products'));
    }
    public function store(){
        $this->saveTools();
        $this->validate();
        $this->configuratorCompatibility->save();
        $this->saveProducts();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.configurator.compatibility.index');
    }
    public function update(){
        $this->saveTools();
        $this->validate();
        $this->configuratorCompatibility->update();
        $this->saveProducts();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.configurator.compatibility.index');
    }
    private function saveTools(){
        $configuratorStageProduct = ConfiguratorStageProduct::where('configurator_stage_id', $this->configuratorStageIdTMP)
        ->where('product_id', $this->configuratorStageProductIdTMP)
        ->first();
        $this->configuratorCompatibility->configurator_stage_product_id = $configuratorStageProduct->id;
        $this->configuratorCompatibility->configurator_stage_id = $this->configuratorStageId;
    }
    private function saveProducts(){
        if(count($this->productsArray)):
           $this->configuratorCompatibility->products()->sync($this->productsArray);
        endif;
    }
    private function getConfiguratorStages(){
        return ConfiguratorStage::orderBy('order')->get();
    }
    private function getConfiguratorStagesProducts(){
        $configuratorStageProducts = [];
        if($this->configuratorStageIdTMP):
            $configuratorStage = ConfiguratorStage::with('products')->where('id', $this->configuratorStageIdTMP)->first();
            $configuratorStageProducts = $configuratorStage->products;
        endif;
        return $configuratorStageProducts;
    }
    private function getProducts(){
        $products = [];
        if($this->configuratorStageId):
            $configuratorStage = ConfiguratorStage::with(['products' => function($query){
                $query->where('products.name', 'LIKE', "%{$this->search}%");
            }])->where('id', $this->configuratorStageId);
            $configuratorStage = $configuratorStage->first();
            if($configuratorStage):
                $products = $configuratorStage->products;
            endif;
        endif;
        return $products;
    }
    private function loadProducts(){
        if($this->configuratorCompatibility->configuratorStageProduct):
            $this->configuratorStageId = $this->configuratorCompatibility->configurator_stage_id;
            $this->configuratorStageIdTMP = $this->configuratorCompatibility->configuratorStageProduct->configuratorStage->id;
            $this->configuratorStageProductIdTMP = $this->configuratorCompatibility->configuratorStageProduct->product->id;
            $this->productsArray = $this->configuratorCompatibility->products()->pluck('product_id')->toArray();
        endif;
    }
    public function updatedConfiguratorStageIdTMP($configuratorStageIdTMP){
        $this->reset('configuratorStageProductIdTMP');
    }
    public function updatedConfiguratorStageId($configuratorStageId){
        $this->reset('productsArray');
    }
}
