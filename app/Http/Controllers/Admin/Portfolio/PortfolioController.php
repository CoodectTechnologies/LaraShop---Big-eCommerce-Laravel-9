<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        return view('admin.portfolio.index');
    }
    public function create(){
        return view('admin.portfolio.create');
    }
    public function edit(Portfolio $project){
        return view('admin.portfolio.edit', compact('project'));
    }
    public function show(Portfolio $project){
        return view('admin.portfolio.show', compact('project'));
    }
}
