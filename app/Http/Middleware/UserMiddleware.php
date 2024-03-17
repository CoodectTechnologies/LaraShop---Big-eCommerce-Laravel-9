<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::find($request->user->id);
        $userPresent = User::find(Auth::user()->id);
        if($user->id === $userPresent->id || $userPresent->can('usuarios')){
            return $next($request);
        }else{
            Session::flash('alert', 'No tienes los permisos suficientes');
            Session::flash('alert-type', 'warning');
            return redirect()->route('admin.dashboard.general.index');
        }
    }
}
