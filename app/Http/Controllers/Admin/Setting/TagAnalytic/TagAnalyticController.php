<?php

namespace App\Http\Controllers\Admin\Setting\TagAnalytic;

use App\Http\Controllers\Controller;
use App\Models\TagAnalytic;
use Illuminate\Http\Request;

class TagAnalyticController extends Controller
{
    public function index(){
        $tagAnalytic = TagAnalytic::getCache();
        return view('admin.setting.tag-analytic.index', compact('tagAnalytic'));
    }
}
