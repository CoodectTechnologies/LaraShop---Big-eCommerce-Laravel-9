<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Color;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $method;
    public $product;
    public $color;
    public $sizeArray = [];
    public $imagesTmp = [], $imagesTmpInputId;

    protected function rules(){
        return [
            'color.name.'.translatable() => 'required',
            'color.quantity' => 'required|numeric',
            'color.hexadecimal' => 'required',
        ];
    }
    public function mount(Product $product, ProductColor $color, $method){
        $this->product = $product;
        $this->color = $color;
        $this->method = $method;
        $this->loadRandomImagesTmpInputId();
    }
    public function render(){
        $productImages = $this->color->images()->orderBy('id', 'desc')->get();
        return view('livewire.admin.catalog.product.color.form', compact('productImages'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->color = $this->product->productColors()->create($this->color->toArray());
        $this->saveImages();
        $this->color = new ProductColor;
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        $this->emitTo('admin.catalog.product.size.form', 'render');
    }
    public function update(){
        $this->validate();
        $this->color->update();
        $this->saveImages();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
        $this->emitTo('admin.catalog.product.size.form', 'render');
    }
    private function saveImages(){
        if($this->imagesTmp):
            foreach ($this->imagesTmp as $imgTmp):
                $url = $imgTmp->store('public/catalog/product/gallery');
                imagesManager($url, 800, $this->color);
            endforeach;
        endif;
    }
    public function removeImageTemp($key){
        if(array_splice($this->imagesTmp, $key, 1)):
            $this->emit('alert', 'success', __('Image successfully deleted'));
        endif;
    }
    public function removeImage(Image $image){
        try{
            if(Storage::exists($image->url)):
                Storage::delete($image->url);
            endif;
            $image->delete();
            $this->emit('alert', 'success', __('Image successfully deleted'));
        }catch(Exception $e){
            $this->emit('alert', 'warning', $e->getMessage());
        }
    }
    private function loadRandomImagesTmpInputId(){
        $this->imagesTmpInputId = rand(1, 1000).'-'.$this->product->id;
    }
}
