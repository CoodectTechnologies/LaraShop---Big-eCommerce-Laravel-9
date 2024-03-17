<?php

namespace App\Http\Controllers\Admin\Dashboard\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('admin.dashboard.blog.index');
    }
}
