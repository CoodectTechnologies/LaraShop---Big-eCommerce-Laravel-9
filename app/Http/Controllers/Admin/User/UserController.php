<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('can:usuarios')->only('index');
        $this->middleware('user')->except('index');
    }
    public function index(){
        return view('admin.user.user.index');
    }
    public function show(User $user){
        return view('admin.user.user.show', compact('user'));
    }
}
