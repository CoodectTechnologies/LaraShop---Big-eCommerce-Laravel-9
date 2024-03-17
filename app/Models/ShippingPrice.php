<?php

namespace App\Models;

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class ShippingPrice extends Model
{
    use HasFactory;

    public static function getShippingMethods($stateId, $zipCode){
        $shippingZoneByLocation = [];
        $shippingZones = ShippingZone::query()
            ->has('states')
            ->with(['states', 'shippingClasses'])
            ->whereRelation('states', 'state_id', $stateId)
            ->get();
        foreach($shippingZones as $shippingZone):
            $addToShippingZone = [
                'id' => $shippingZone->id,
                'name' => $shippingZone->alias,
                'price' => self::getShippingPriceByZone($shippingZone),
                'days' => $shippingZone->shipping_days,
                'estimatedDate' => Carbon::parse(today())->addDays($shippingZone->shipping_days)->toFormattedDateString()
            ];
            if(!$shippingZone->zip_codes || in_array($zipCode, explode(',', $shippingZone->zip_codes))):
                $shippingZoneByLocation[$shippingZone->id] = $addToShippingZone;
            else:
                foreach(explode(',', $shippingZone->zip_codes) as $zipCodeRange):
                    $zipCodeRange = trim($zipCodeRange);
                    if(str_contains($zipCodeRange, '...')):
                        [$zipCodeStart, $zipCodeEnd] = array_map('trim', explode('...', $zipCodeRange));
                        if(strcmp($zipCode, $zipCodeStart) >= 0 && strcmp($zipCode, $zipCodeEnd) <= 0):
                            $shippingZoneByLocation[$shippingZone->id] = $addToShippingZone;
                            break;
                        endif;
                    endif;
                endforeach;
            endif;
        endforeach;
        return $shippingZoneByLocation;
    }
    protected static function getShippingPriceByZone($shippingZone){
        $subtotal = floatval(str_replace(',', '', Cart::instance('default')->subtotal()));
        $priceWithoutShippingClass = $shippingZone->price;
        $priceWithShippingClassQty = 0;
        $priceWithShippingClass = 0;
        $shippingClassIdsRepeat = [];
        if(!$shippingZone || ($shippingZone->free_shipping_over_to && $subtotal >= $shippingZone->free_shipping_over_to)):
            return 0;
        endif;
        foreach(Cart::instance('default')->content() as $item):
            if(!$item->model->shippingClass):
                continue;
            endif;
            $shippingClass = $shippingZone->shippingClasses->where('id', $item->model->shippingClass->id)->first();
            if($shippingClass):
                $pivotPrice = $shippingClass->pivot->price;
                if($shippingClass->pivot->multiply_quantity):
                    $toQty = max(1, floor($item->qty / $shippingClass->pivot->multiply_quantity));
                    $priceWithShippingClassQty += ($pivotPrice * $toQty);
                    $priceWithoutShippingClass = 0;
                else:
                    if(!in_array($shippingClass->id, $shippingClassIdsRepeat)):
                        $shippingClassIdsRepeat[] = $shippingClass->id;
                        $priceWithShippingClass += $pivotPrice;
                        $priceWithoutShippingClass = 0;
                    endif;
                endif;
            endif;
        endforeach;
        $price = $priceWithShippingClassQty + $priceWithShippingClass + $priceWithoutShippingClass;
        $currency = Currency::getCurrencyByCode(Session::get('currency'));
        if($currency && $currency->value):
            $price = floatval(number_format($price / $currency->value, 2));
        endif;
        return $price;
    }

}
