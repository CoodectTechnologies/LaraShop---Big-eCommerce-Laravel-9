<?php

namespace App\Http\Controllers\Admin\Setting\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        return view('admin.setting.country.index');
    }
}
