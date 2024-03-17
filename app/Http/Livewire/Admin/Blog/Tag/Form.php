<?php

namespace App\Http\Livewire\Admin\Blog\Tag;

use App\Models\BlogTag;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $blogTag;

    public function mount(BlogTag $blogTag, $method){
        $this->blogTag = $blogTag;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'blogTag.name.'.translatable()  => 'required',
        ];
    }
    public function render(){
        return view('livewire.admin.blog.tag.form');
    }
    public function store(){
        $this->validate();
        $this->blogTag->save();
        $this->blogTag = new BlogTag();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->blogTag->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
