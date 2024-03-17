<?php

namespace App\Http\Livewire\Admin\Gallery;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\ModuleWeb;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $gallery;
    public $method;
    public $imagesTmp = [], $imagesTmpInputId;

    protected function rules(){
        return [
            'gallery.module_web_id' => 'required|exists:module_webs,id',
            'imagesTmp' => count($this->gallery->images) ? 'nullable' : 'required',
        ];
    }
    public function mount(Gallery $gallery, $method){
        $this->gallery = $gallery;
        $this->method = $method;
        $this->loadRandomImagesTmpInputId();
    }
    public function render(){
        $galleryImages = $this->gallery->images()->get();
        $modulesWeb = ModuleWeb::where('name', 'Ecommerce - Galeria')->orderBy('id')->get();
        return view('livewire.admin.gallery.form', compact('galleryImages', 'modulesWeb'));
    }
    public function store(){
        $this->validate();
        $this->gallery->save();
        $this->saveImages();
        $this->gallery = new Gallery();
        Cache::forget('galleries');
        $this->loadRandomImagesTmpInputId();
        $this->reset('imagesTmp');
        $this->emit('alert', 'success', 'Galería agregadas con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->gallery->update();
        $this->saveImages();
        Cache::forget('galleries');
        $this->loadRandomImagesTmpInputId();
        $this->reset('imagesTmp');
        $this->emit('alert', 'success', 'Galería actualizadas con éxito');
        $this->emit('render');
    }
    public function saveImages(){
        if($this->imagesTmp):
            foreach ($this->imagesTmp as $imageTmp):
                $url = $imageTmp->store('public/gallery/'.strtolower($this->gallery->module));
                imagesManager($url, 800, $this->gallery);
            endforeach;
        endif;
    }
    public function removeImageTemp($key){
        if(array_splice($this->imagesTmp, $key, 1)):
            $this->emit('alert', 'success', __('Image successfully deleted'));
        endif;
    }
    public function removeImage(Image $image){
        $image->delete();
        Cache::forget('galleries');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
    protected function loadRandomImagesTmpInputId(){
        $this->imagesTmpInputId = rand(1, 1000).'-'.$this->gallery->id;
    }
}
