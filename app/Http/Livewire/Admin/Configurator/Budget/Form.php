<?php

namespace App\Http\Livewire\Admin\Configurator\Budget;

use App\Models\ConfiguratorStageProduct;
use Illuminate\Support\Facades\Redirect;
use App\Models\ConfiguratorBudget;
use App\Models\ConfiguratorChipset;
use App\Models\ConfiguratorPerformance;
use App\Models\ConfiguratorStage;
use App\Models\Product;
use Livewire\Component;

class Form extends Component
{
    public $configuratorBudget;
    public $method;

    public $productsArray = ['products' => [], 'configurator_stage_product' => []];
    public $performancesArray = [];
    public $total = 0;

    public function rules(){
        return [
            'configuratorBudget.configurator_chipset_id' => 'required',
            'configuratorBudget.amount' => 'required'
        ];
    }
    public function mount(ConfiguratorBudget $configuratorBudget, $method){
        $this->configuratorBudget = $configuratorBudget;
        $this->method = $method;
        $this->loadProducts();
        $this->loadPerformances();
        $this->loadTotal();
    }
    public function render(){
        $stages = ConfiguratorStage::where('type', ConfiguratorStage::TYPE_COMPONENT)->orderBy('order')->get();
        $chipsets = ConfiguratorChipset::orderByDesc('id')->get();
        $performances = ConfiguratorPerformance::orderByDesc('id')->get();
        return view('livewire.admin.configurator.budget.form', compact('stages', 'chipsets', 'performances'));
    }
    public function store(){
        $this->validate();
        $this->validateProducts();
        $this->configuratorBudget->save();
        $this->saveProducts();
        $this->savePerformances();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.configurator.budget.index');
    }
    public function update(){
        $this->validate();
        $this->validateProducts();
        $this->configuratorBudget->update();
        $this->saveProducts();
        $this->savePerformances();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.configurator.budget.index');
    }
    private function saveProducts(){
        foreach($this->productsArray['products'] as $stageId => $productId):
            $stageProductId = ConfiguratorStageProduct::where('configurator_stage_id', $stageId)->where('product_id', $productId)->first()->id;
            $this->productsArray['configurator_stage_product'][$stageId] = $stageProductId;
        endforeach;
        if(count($this->productsArray['configurator_stage_product'])):
            $this->configuratorBudget->configuratorStageProducts()->sync($this->productsArray['configurator_stage_product']);
        endif;
    }
    private function savePerformances(){
        $this->configuratorBudget->configuratorPerformances()->sync($this->performancesArray);
    }
    private function getProducts($stageId){
        $products = [];
        $products = ConfiguratorStage::with('products')->find($stageId)->products;
        foreach($this->productsArray['products'] as $productId):
            $stage = ConfiguratorStage::with([
                'configuratorCompatibilities.products.productSizes',
                'configuratorCompatibilities.products.productColors'
            ])
             ->whereHas('configuratorCompatibilities.configuratorStageProduct', function($query) use($productId){
                $query->where('product_id', $productId);
            })
            ->find($stageId);
            if($stage):
                foreach($stage->configuratorCompatibilities as $configuratorCompatibility):
                    if($configuratorCompatibility->configuratorStageProduct->product_id == $productId):
                        $products = $configuratorCompatibility->products;
                        break;
                    endif;
                endforeach;
            endif;
        endforeach;
        return $products;
    }
    private function validateCompatibilities(){
        foreach($this->productsArray['products'] as $stageId => $productId):
            $products = $this->getProducts($stageId);
            if(!$products->contains($productId)):
                $this->addError('productsArray.products.'.$stageId, __('Select another product.'));
                unset($this->productsArray['configurator_stage_product'][$stageId]);
                unset($this->productsArray['products'][$stageId]);
            else:
                $this->resetErrorBag('productsArray.products.'.$stageId);
            endif;
        endforeach;
    }
    public function updatedProductsArray($productId){
        foreach($this->productsArray['products'] as $stageId => $productId):
            if(!$productId):
                unset($this->productsArray['products'][$stageId]);
            endif;
        endforeach;
        $this->validateCompatibilities();
        $this->loadTotal();
    }
    private function loadProducts(){
        if($this->configuratorBudget->exists):
            $this->configuratorBudget->load([
                'configuratorStageProducts.configuratorStage',
                'configuratorStageProducts.product',
            ]);
            foreach($this->configuratorBudget->configuratorStageProducts as $configuratorStageProduct):
                $productId = $configuratorStageProduct->product->id;
                $stageId = $configuratorStageProduct->configuratorStage->id;
                $this->productsArray['products'][$stageId] = $productId;
            endforeach;
        endif;
    }
    private function loadPerformances(){
        $this->performancesArray = $this->configuratorBudget->configuratorPerformances()->pluck('configurator_performance_id');
    }
    private function validateProducts(){
        $validateProducts = [];
        $stages = ConfiguratorStage::where('type', ConfiguratorStage::TYPE_COMPONENT)->orderBy('order')->get();
        foreach($stages as $stage):
            $validateProducts['productsArray.products.'.$stage->id] = $stage->optional ? 'nullable' : 'required';
        endforeach;
        $this->validate($validateProducts);
    }
    private function loadTotal(){
        $this->total = 0;
        foreach($this->productsArray['products'] as $productId):
            $product = Product::find($productId);
            $this->total += $product->getPriceFInal();
        endforeach;
    }
}
