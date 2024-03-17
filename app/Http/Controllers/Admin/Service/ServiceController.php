<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        return view('admin.service.index');
    }
    public function create(){
        return view('admin.service.create');
    }
    public function edit(Service $service){
        return view('admin.service.edit', compact('service'));
    }
    public function show(Service $service){
        return view('admin.service.show', compact('service'));
    }
}
