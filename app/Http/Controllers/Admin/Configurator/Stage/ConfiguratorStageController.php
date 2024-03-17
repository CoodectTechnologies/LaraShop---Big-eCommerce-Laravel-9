<?php

namespace App\Http\Controllers\Admin\Configurator\Stage;

use App\Http\Controllers\Controller;
use App\Models\ConfiguratorStage;
use Illuminate\Http\Request;

class ConfiguratorStageController extends Controller
{
    public function index(){
        return view('admin.configurator.stage.index');
    }
    public function create(){
        return view('admin.configurator.stage.create');
    }
    public function edit(ConfiguratorStage $configuratorStage){
        return view('admin.configurator.stage.edit', compact('configuratorStage'));
    }
}
