<?php

namespace App\Http\Livewire\Admin\Catalog\Brand;

use App\Models\ProductBrand;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $brand;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'brand.name.'.translatable() => 'required',
            'imageTmp' => 'image|nullable',
        ];
    }
    public function mount(ProductBrand $brand, $method){
        $this->brand = $brand;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.catalog.brand.form');
    }
    public function store(){
        $this->validate();
        $this->brand->save();
        $this->saveImage();
        $this->brand = new ProductBrand();
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->brand->update();
        $this->saveImage();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/catalog/brand');
            imageManager($url, 200, $this->brand);
        endif;
    }
    public function removeImage(){
        if($this->brand->image):
            if(Storage::exists($this->brand->image->url)):
                Storage::delete($this->brand->image->url);
            endif;
            $this->brand->image()->delete();
            $this->brand->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
}
