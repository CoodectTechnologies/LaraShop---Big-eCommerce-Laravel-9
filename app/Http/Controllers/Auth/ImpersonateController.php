<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class ImpersonateController extends Controller
{
    public function signin(User $user){
        Session::put('impersonated_by', Auth::id());
        Auth::login($user);
        if(Route::has('ecommerce.home.index')):
            return Redirect::route('ecommerce.home.index');
        endif;
    }
    public function logout(){
        if(!$impersonatedBy = Session::get('impersonated_by')):
            Session::flash('alert', 'No existe un usuario al cual regresar');
            Session::flash('alert-type', 'warning');
            if(Route::has('ecommerce.home.index')):
                return Redirect::route('ecommerce.home.index');
            endif;
        endif;
        $userInSession = User::find(Auth::id());
        $user = User::find($impersonatedBy);
        Auth::login($user);
        Session::put('impersonated_by', null);
        return Redirect::route('admin.user.show', $userInSession);
    }
}
