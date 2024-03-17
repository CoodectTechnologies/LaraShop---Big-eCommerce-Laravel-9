<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ConfiguratorBudget extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Configurador rangos')
        ->setDescriptionForEvent(fn(string $eventName) => "Un rango del configurador ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function configuratorStageProducts(){
        return $this->belongsToMany(ConfiguratorStageProduct::class);
    }
    public function configuratorPerformances(){
        return $this->belongsToMany(ConfiguratorPerformance::class);
    }
    public function configuratorChipset(){
        return $this->belongsTo(ConfiguratorChipset::class);
    }
    public function getAmount(){
        $amount = $this->amount;
        $currency = Currency::validate()->where('code', Session::get('currency'))->first();
        if($currency && $currency->value):
            $amount = $amount / $currency->value;
        endif;
        return $amount;
    }
    public function amountToString(){
        return '$'.number_format($this->getAmount(), 2);
    }
}
