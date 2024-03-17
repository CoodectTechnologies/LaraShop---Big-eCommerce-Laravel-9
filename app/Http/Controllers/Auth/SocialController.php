<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\User;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function loginWithGoogle(){
        try {
            $userSocial = Socialite::driver('google')->user();
            $user = User::where('email', $userSocial->email)->first();
            if(!$user):
                $user = User::create([
                    'name' => $userSocial->name,
                    'email' => $userSocial->email,
                    'google_id' => $userSocial->id,
                    'connected_google' => true
                ]);
                $user->image()->create([
                    'url' => $userSocial->avatar,
                    'name' => $userSocial->avatar,
                ]);
                if(Route::has('ecommerce.home.index')):
                    $user->assignRole('Cliente');
                endif;
                //Registrar en el newsletters
                Subscriber::create(['email' => $user->email]);
            endif;
            if(!$user->connected_google):
                session()->flash('alert', __('Google login has been disabled. contact support'));
                session()->flash('alert-type', 'warning');
                return Redirect::route('login');
            else:
                Auth::login($user);
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
                else:
                    if(Route::has('ecommerce.home.index')):
                        return Redirect::route('ecommerce.home.index');
                    endif;
                endif;
            endif;
        }catch(Exception $exception){
            session()->flash('alert', __('Login not complete').': '.$exception->getMessage());
            session()->flash('alert-type', 'warning');
            return Redirect::route('login');
        }
    }
}
