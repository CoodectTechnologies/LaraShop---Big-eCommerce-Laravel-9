<?php

namespace App\Http\Controllers\Admin\Setting\AccessMailchimp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessMailchimpController extends Controller
{
    public function index(){
        return view('admin.setting.access-mailchimp.index');
    }
}
