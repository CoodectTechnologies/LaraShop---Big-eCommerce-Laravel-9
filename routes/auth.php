<?php

use App\Http\Controllers\Auth\ImpersonateController;
use App\Http\Controllers\Auth\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Access
Auth::routes();
//Socialite
Route::get('login/google', [SocialController::class, 'googleRedirect'])->name('login.google');
Route::get('login/google/callback', [SocialController::class, 'loginWithGoogle'])->name('login.google.redirect');
//Impersonate
Route::middleware('panel')->post('impersonate/{user}', [ImpersonateController::class, 'signin'])->name('impersonate.signin');
Route::delete('impersonate', [ImpersonateController::class, 'logout'])->name('impersonate.logout');
