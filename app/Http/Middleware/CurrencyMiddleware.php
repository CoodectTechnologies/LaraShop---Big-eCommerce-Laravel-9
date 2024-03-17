<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Ecommerce\Currency\CurrencyController;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Currency;
use Closure;

class CurrencyMiddleware
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
        $currency = Currency::getDefault();
        $currencies = Currency::getCache();
        $currencyCode = $currency->code;
        $countriesLocales = config('translatable.countries');
        if(
            Session::has('currency') &&
            in_array(Session::get('currency'), $currencies->pluck('code')->toArray())
        ):
            $currencyCode = Session::get('currency');
        elseif(
            Session::has('currency') &&
            !in_array(Session::get('currency'), $currencies->pluck('code')->toArray())
        ):
            CurrencyController::cartCurrencySwitcher($currencyCode);
        else:
            if($location = Location::get(request()->ip())):
                if(isset($countriesLocales[$location->countryName]['currency_code'])):
                    $currencyCode = $countriesLocales[$location->countryName]['currency_code'];
                endif;
            endif;
        endif;
        $this->putCurrency($currencyCode);
        return $next($request);
    }
    private function putCurrency($currencyCode){
        Session::put('currency', $currencyCode);
    }
}
