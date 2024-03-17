<?php

namespace App\Http\Controllers\Ecommerce\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('ecommerce.category.index');
    }
}
