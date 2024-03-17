<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ConfiguratorCompatibility extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Configurador compatibilidad')
        ->setDescriptionForEvent(fn(string $eventName) => "Una compatibilidad del configurador ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function configuratorStage(){
        return $this->belongsTo(ConfiguratorStage::class);
    }
    public function configuratorStageProduct(){
        return $this->belongsTo(ConfiguratorStageProduct::class);
    }
}
