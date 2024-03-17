<?php

namespace App\Http\Controllers\Admin\Promotion;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(){
        return view('admin.promotion.index');
    }
    public function create(){
        return view('admin.promotion.create');
    }
    public function edit(Promotion $promotion){
        return view('admin.promotion.edit', compact('promotion'));
    }
}
