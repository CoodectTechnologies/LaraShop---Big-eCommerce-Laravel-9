<?php

namespace App\Http\Controllers\Admin\Setting\AccessGoogle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessGoogleController extends Controller
{
    public function index(){
        return view('admin.setting.access-google.index');
    }
}
