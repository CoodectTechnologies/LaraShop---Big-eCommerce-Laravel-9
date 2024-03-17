<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ShippingZone extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Zonas de envío')
        ->setDescriptionForEvent(fn(string $eventName) => "Una zona de envío ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function states(){
        return $this->belongsToMany(State::class);
    }
    public function shippingClasses(){
        return $this->belongsToMany(ShippingClass::class)->withTimestamps()->withPivot(['price', 'multiply_quantity']);
    }
    public function priceToString(){
        return '$'.number_format($this->price, 2);
    }
    public function priceFreeOverToString(){
        if($this->free_shipping_over_to):
            return '$'.number_format($this->free_shipping_over_to, 2);
        else:
            return __('N/A');
        endif;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
