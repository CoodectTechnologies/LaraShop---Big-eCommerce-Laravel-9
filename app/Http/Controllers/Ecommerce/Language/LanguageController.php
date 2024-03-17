<?php

namespace App\Http\Controllers\Ecommerce\Language;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function __invoke($language){
        Session::put('language', $language);
        return Redirect::back();
    }
}
