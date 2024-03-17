<?php

namespace App\Http\Controllers\Admin\Configurator\FPS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfiguratorFPSController extends Controller
{
    public function index(){
        return view('admin.configurator.fps.index');
    }
}
