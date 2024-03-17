<?php

namespace App\Http\Livewire\Ecommerce\Blog;

use App\Models\BlogPost;
use Livewire\Component;

class Show extends Component
{
    public $post;

    public function mount(BlogPost $post){
        $this->post = $post;
    }
    public function render(){
        $comments = $this->post->comments()->where('approved', true)->get();
        $next = BlogPost::where('id', '>', $this->post->id)->orderByDesc('id')->first();
        $previous = BlogPost::where('id', '<', $this->post->id)->orderByDesc('id')->first();
        $postsRelated = BlogPost::whereHas('blogCategories', function($query){
            $query->whereIn('blog_category_id', $this->post->blogCategories()->pluck('blog_category_id'));
        })
        ->where('id', '<>', $this->post->id)
        ->get();
        return view('livewire.ecommerce.blog.show', compact('comments', 'next', 'previous', 'postsRelated'));
    }
}
