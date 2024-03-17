<?php

namespace App\Http\Livewire\Admin\Catalog\Category;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $category;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'category.parent_id' => 'nullable|max:1',
            'category.name.'.translatable() => 'required',
            'category.description.'.translatable() => 'nullable',
            'imageTmp' => 'image|nullable'
        ];
    }
    public function mount(ProductCategory $category, $method){
        $this->category = $category;
        $this->method = $method;
    }
    public function render(){
        $categories = ProductCategory::with(['allChildrens' => function($query){
            $query->orderBy('name', 'asc');
        }])->whereNull('parent_id')->orderBy('name', 'asc')->get();
        return view('livewire.admin.catalog.category.form', compact('categories'));
    }
    public function store(){
        $this->validate();
        $this->saveCategoryParent();
        $this->category->save();
        $this->saveImage();
        $this->category = new ProductCategory();
        $this->reset('imageTmp');
        ProductCategory::regenerateCache();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->saveCategoryParent();
        $this->category->update();
        $this->saveImage();
        ProductCategory::regenerateCache();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    private function saveCategoryParent(){
        if(isset($this->category->parent_id[0])): //Si se eligio una categoria padre
            if($this->category->parent_id[0]): //Si no es 0, ya que 0 es "Sin categoría padre"
                $parentId = $this->category->parent_id[0];
            else:
                $parentId = null;
            endif;
        else: //No eligio una categoria padre
            if($this->category->parent_id): //Se pondrá el parent_id que ya se tiene registrado
                $parentId = $this->category->parent_id;
            else:
                $parentId = null;
            endif;
        endif;
        $this->category->parent_id = $parentId;
    }
    public function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/catalog/category');
            imageManager($url, 260, $this->category);
        endif;
    }
    public function removeImage(){
        if($this->category->image):
            if(Storage::exists($this->category->image->url)):
                Storage::delete($this->category->image->url);
            endif;
            $this->category->image()->delete();
            $this->category->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
}
