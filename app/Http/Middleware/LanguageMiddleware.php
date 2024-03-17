<?php

namespace App\Http\Middleware;

use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Closure;

class LanguageMiddleware
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
        $language = config('translatable.fallback');
        $languagesLocales = config('translatable.locales');
        $countriesLocales = config('translatable.countries');

        if(config('translatable.status')):
            if(
                Session::has('language') &&
                App::getLocale() != Session::get('language') &&
                isset($languagesLocales[Session::get('language')])
            ):
                $language = Session::get('language');
            else:
                if($location = Location::get(request()->ip())):
                    if(isset($countriesLocales[$location->countryName])):
                        $language = $countriesLocales[$location->countryName]['language'];
                    endif;
                endif;
            endif;
        endif;
        $this->putLanguage($language);
        return $next($request);
    }
    private function putLanguage($language){
        Session::put('language', $language);
        App::setLocale($language);
    }
}
