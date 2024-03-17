<?php

namespace App\Http\Controllers\Admin\Configurator\Budget;

use App\Http\Controllers\Controller;
use App\Models\ConfiguratorBudget;
use Illuminate\Http\Request;

class ConfiguratorBudgetController extends Controller
{
    public function index(){
        return view('admin.configurator.budget.index');
    }
    public function create(){
        return view('admin.configurator.budget.create');
    }
    public function edit(ConfiguratorBudget $configuratorBudget){
        return view('admin.configurator.budget.edit', compact('configuratorBudget'));
    }
}
