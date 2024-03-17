<?php

namespace App\Http\Controllers\Admin\Setting\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        return view('admin.setting.log.index');
    }
}
