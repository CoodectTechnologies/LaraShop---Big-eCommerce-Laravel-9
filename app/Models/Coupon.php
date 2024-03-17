<?php

namespace App\Models;

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Cupón')
        ->setDescriptionForEvent(fn(string $eventName) => "Un cupón ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function currencies(){
        return $this->belongsToMany(Currency::class)->withTimestamps();
    }
    public function dateEndToString(){
        return Carbon::parse($this->date_end)->toFormattedDateString();
    }
    public function minimumExpenseToString(){
        return '$'.number_format($this->minimum_expense, 2);
    }
    public function isTimedOut(){
        $isTimedOut = false;
        if(strtotime($this->date_end) <= strtotime(date('Y-m-d'))):
            $isTimedOut = true;
        endif;
        return $isTimedOut;
    }
    public function isExceededLimitOfUse(){
        $exceededLimitOfUse = false;
        if(
            $this->limit_of_use &&
            ($this->orders()->count() >= $this->limit_of_use)
        ):
            $exceededLimitOfUse = true;
        endif;
        return $exceededLimitOfUse;
    }
    public function isExcludePromotion(){
        $excludePromotion = false;
        if($this->exclude_promotion):
            if(Cart::instance('default')->count()):
                foreach(Cart::instance('default')->content() as $item):
                    if($item->model->getPromotion()):
                        $excludePromotion = true;
                    endif;
                endforeach;
            endif;
        endif;
        return $excludePromotion;
    }
}
