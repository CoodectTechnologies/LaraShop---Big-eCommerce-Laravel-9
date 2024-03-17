<?php

namespace App\Http\Controllers\Admin\Wholesale;

use App\Http\Controllers\Controller;
use App\Models\Wholesale;
use Illuminate\Http\Request;

class WholesaleController extends Controller
{
    public function index(){
        return view('admin.wholesale.index');
    }
    public function create(){
        return view('admin.wholesale.create');
    }
    public function edit(Wholesale $wholesale){
        return view('admin.wholesale.edit', compact('wholesale'));
    }
}
