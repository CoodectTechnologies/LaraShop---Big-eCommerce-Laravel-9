<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('admin.blog.post.index');
    }
    public function create(){
        return view('admin.blog.post.create');
    }
    public function edit(BlogPost $post){
        return view('admin.blog.post.edit', compact('post'));
    }
    public function show(BlogPost $post){
        return view('admin.blog.post.show', compact('post'));
    }
}
