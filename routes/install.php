<?php

use App\Http\Controllers\Install\Complete\CompleteController;
use App\Http\Controllers\Install\Database\DatabaseController;
use App\Http\Controllers\Install\Email\EmailController;
use App\Http\Controllers\Install\General\GeneralController;
use App\Http\Controllers\Install\User\UserController;
use Illuminate\Support\Facades\Route;

//General
Route::resource('/', GeneralController::class)->names('general');
//Database
Route::resource('/database', DatabaseController::class)->names('database');
Route::get('/test-connection', [DatabaseController::class, 'testConnection'])->name('database.test-connection');
//Email
Route::resource('/email', EmailController::class)->names('email');
//User
Route::resource('/user', UserController::class)->names('user');
//Complete
Route::resource('/complete', CompleteController::class)->names('complete');

