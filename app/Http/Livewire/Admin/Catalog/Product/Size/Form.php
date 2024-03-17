<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Size;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Livewire\Component;

class Form extends Component
{

    protected $listeners = ['render'];

    public $product;
    public $size;
    public $method;
    public $sizeColors = [];
    public $sizeColorsTMP = [];

    protected function rules(){
        return [
            'size.name.'.translatable() => 'required',
            'size.price' => 'required',
            'size.quantity' => $this->size->relation_with_colors == 'SI' ? 'nullable' : 'required',
            'size.relation_with_colors' => 'required',
            'sizeColors' => $this->size->relation_with_colors == 'SI' ? 'required' : 'nullable',
            'sizeColorsTMP' => $this->size->relation_with_colors == 'SI' ? 'required|array|min:1' : 'nullable',
            'sizeColorsTMP.*.quantity' => $this->size->relation_with_colors == 'SI' ? 'required|numeric' : 'nullable',
        ];
    }
    public function mount(Product $product, ProductSize $size, $method){
        $this->product = $product;
        $this->size = $size;
        $this->method = $method;
        $this->size->price = $this->size->price ?? $this->product->price;
        $this->_loadSizeColors();
        $this->_loadSizeColorsTMP();
    }
    public function render(){
        $colors = $this->product->productColors()->get();
        return view('livewire.admin.catalog.product.size.form', compact('colors'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->size = $this->product->productSizes()->create($this->size->toArray());
        $this->saveColors();
        $this->size = new ProductSize;
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->size->update();
        $this->saveColors();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    /* ======= SAVES ====== */
    private function saveColors(){
        if($this->size->relation_with_colors == 'SI'):
            $syncSizeColors = [];
            foreach($this->sizeColorsTMP as $colorId => $sizeColorTMP):
                $syncSizeColors[$colorId] = ['quantity' => $sizeColorTMP['quantity']];
            endforeach;
            $this->size->productColors()->sync($syncSizeColors);
        endif;
    }
    /*===== LOADS =====*/
    private function _loadSizeColors(){
        $this->sizeColors = $this->size->productColors()->pluck('product_color_id')->toArray();
    }
    private function _loadSizeColorsTMP(){
        $colors = $this->size->productColors()->get();
        foreach($colors as $color):
            $this->sizeColorsTMP[$color->id] = [
                'quantity' => $color->pivot->quantity,
                'color' => $color->name
            ];
        endforeach;
    }
    /*===== INPUTS DINAMICS =====*/
    public function updatedSizeColors($colors){
        $colorIdSelecteds = [];
        foreach($colors as $colorId):
            $colorIdSelecteds[$colorId] = $colorId;
        endforeach;
        foreach($this->sizeColorsTMP as $colorId => $sizeColorTMP):
            if(!isset($colorIdSelecteds[$colorId])):
                unset($this->sizeColorsTMP[$colorId]);
            endif;
        endforeach;
        foreach($colors as $colorId):
            if(isset($this->sizeColorsTMP[$colorId])):
                continue;
            endif;
            $colorModel = ProductColor::find($colorId);
            $this->sizeColorsTMP[$colorModel->id] = [
                'quantity' => $colorModel->quantity,
                'color' => $colorModel->name
            ];
        endforeach;
    }
}
