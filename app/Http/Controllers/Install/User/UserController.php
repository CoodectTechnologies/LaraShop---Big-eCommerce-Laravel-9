<?php

namespace App\Http\Controllers\Install\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(){
        return view('install.user.index');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'string|min:8|confirmed',
        ]);
        $name = $request['name'];
        $email = $request['email'];
        $password = Hash::make($request['password']);
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        $user->assignRole('Administrador');
        return Redirect::route('install.complete.index');
    }
}
