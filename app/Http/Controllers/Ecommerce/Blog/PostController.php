<?php

namespace App\Http\Controllers\Ecommerce\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request){
        return view('ecommerce.post.index');
    }
    public function show(BlogPost $post){
        $post->load('blogTags', 'blogCategories');
        views($post)->cooldown(now()->addHours(1))->record();
        return view('ecommerce.post.show', compact('post'));
    }
}
