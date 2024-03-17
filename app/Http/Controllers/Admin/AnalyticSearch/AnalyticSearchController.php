<?php

namespace App\Http\Controllers\Admin\AnalyticSearch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticSearchController extends Controller
{
    public function index(){
        return view('admin.analytic-search.index');
    }
}
