<?php

namespace App\Http\Controllers\Admin\EmailWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailWebController extends Controller
{
    public function index(){
        return view('admin.email-web.index');
    }
}
