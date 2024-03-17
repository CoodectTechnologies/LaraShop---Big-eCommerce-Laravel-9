<?php

namespace App\Http\Controllers\Admin\Setting\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.setting.permission.index');
    }

}
