<?php

namespace App\Http\Controllers\Admin\Setting\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        return view('admin.setting.role.index');
    }
    public function show(Role $role){
        return view('admin.setting.role.show', compact('role'));
    }
}
