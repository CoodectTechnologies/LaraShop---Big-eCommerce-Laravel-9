<?php

namespace App\Http\Livewire\Admin\Blog\Tag;

use App\Models\BlogTag;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $blogTags = BlogTag::with('blogPosts')->orderBy('id', 'desc')->get();
        return view('livewire.admin.blog.tag.index', compact('blogTags'));
    }
    public function destroy(BlogTag $blogTag){
        try{
            $blogTag->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
