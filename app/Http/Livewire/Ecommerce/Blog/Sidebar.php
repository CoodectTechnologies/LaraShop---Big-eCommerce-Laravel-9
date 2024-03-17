<?php

namespace App\Http\Livewire\Ecommerce\Blog;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use Livewire\Component;

class Sidebar extends Component
{
    public function render(){
        $categories = BlogCategory::has('blogPosts')->orderBy('id', 'desc')->get();
        $tags = BlogTag::has('blogPosts')->orderBy('id', 'desc')->get();
        return view('livewire.ecommerce.blog.sidebar', compact('categories', 'tags'));
    }
}
