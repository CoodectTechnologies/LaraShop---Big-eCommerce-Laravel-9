<?php

namespace App\Http\Livewire\Ecommerce\Blog;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $tag;
    public $category;

    public function mount(Request $request){
        if($request->search):
            $this->search = $request->search;
        endif;
        if($request->tag):
            $this->tag = $request->tag;
        endif;
        if($request->category):
            $this->category = $request->category;
        endif;
    }
    public function render(){
        $posts = BlogPost::with('blogTags', 'blogCategories', 'user')->orderBy('id', 'desc');
        $posts = $this->filters($posts);
        $posts = $posts->paginate(20);
        return view('livewire.ecommerce.blog.index', compact('posts'));
    }
    private function filters($posts){
        if($this->search):
            $posts = $posts->where('name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->tag):
            $posts = $posts->whereRelation('blogTags', 'name', 'LIKE', "%{$this->tag}%");
        endif;
        if($this->category):
            $posts = $posts->whereRelation('blogCategories', 'name', 'LIKE', "%{$this->category}%");
        endif;
        return $posts;
    }
}
