<?php

namespace App\Http\Controllers\Admin\Setting\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('admin.setting.contact.index');
    }
}
