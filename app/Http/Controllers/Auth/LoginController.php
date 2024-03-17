<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated($request , $user){
        // Auth::logoutOtherDevices($request->password);
        if(Route::has('ecommerce.cart.index')):
            Cart::instance('default')->restore(Auth::id());
        endif;
        if(Route::has('ecommerce.wishlist.index')):
            Cart::instance('wishlist')->restore(Auth::id());
        endif;
        if(Route::has('ecommerce.compare.index')):
            Cart::instance('compare')->restore(Auth::id());
        endif;
        if($user->accessToPanel()):
            return Redirect::route('admin.dashboard.general.index');
        endif;
    }
}
