<?php

namespace App\Http\Livewire\Admin\Blog\Category;

use App\Models\BlogCategory;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $blogCategory;

    public function mount(BlogCategory $blogCategory, $method){
        $this->blogCategory = $blogCategory;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'blogCategory.name.'.translatable() => 'required|unique_translation:blog_categories,name,'.$this->blogCategory->id,
        ];
    }
    public function render(){
        return view('livewire.admin.blog.category.form');
    }
    public function store(){
        $this->validate();
        $this->blogCategory->save();
        $this->blogCategory = new BlogCategory();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->blogCategory->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
