<?php

namespace App\Http\Controllers\Admin\Setting\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfiguratorController extends Controller
{
    public function index(){
        return view('admin.setting.configurator.index');
    }
}
