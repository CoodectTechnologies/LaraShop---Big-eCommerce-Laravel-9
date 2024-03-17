<?php

namespace App\Http\Controllers\Ecommerce\Configurator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConfiguratorController extends Controller
{
    public function index(){
        if(!config('configurator.active')):
            return Redirect::route('ecommerce.home.index');
        endif;
        return view('ecommerce.configurator.index');
    }
}
