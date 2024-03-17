<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.catalog.product.product.index');
    }
    public function create(){
        return view('admin.catalog.product.product.create');
    }
    public function edit(Product $product){
        return view('admin.catalog.product.product.edit', compact('product'));
    }
    public function show(Product $product){
        return view('admin.catalog.product.product.show', compact('product'));
    }
}
