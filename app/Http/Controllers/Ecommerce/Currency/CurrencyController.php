<?php

namespace App\Http\Controllers\Ecommerce\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    public function __invoke($currency){
        self::cartCurrencySwitcher($currency);
        Session::put('currency', $currency);
        return Redirect::back();
    }
    public static function cartCurrencySwitcher($currencyCode){
        $currencyCodeOld = Session::get('currency');
        if($currencyCode != $currencyCodeOld):
            foreach(Cart::content('default') as $item):
                $currency = Currency::where('code', $currencyCode)->first();
                $currencyOld = Currency::where('code', $currencyCodeOld)->first();
                $price = floatval($item->price);
                if($currency && $currencyOld && $price):
                    if($currency->default):
                        $price = floatval($item->price * $currencyOld->value);
                    else:
                        $price = floatval($item->price / $currency->value);
                    endif;
                    $options = $item->options->toArray();
                    $options['currency'] = $currencyCode;
                    $options['price'] = $price;
                    Cart::instance('default')->update($item->rowId, [
                        'price' => $price,
                        'options' => $options
                    ]);
                endif;
            endforeach;
        endif;
    }
}
