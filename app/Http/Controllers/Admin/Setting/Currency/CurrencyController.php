<?php

namespace App\Http\Controllers\Admin\Setting\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(){
        return view('admin.setting.currency.index');
    }
}
