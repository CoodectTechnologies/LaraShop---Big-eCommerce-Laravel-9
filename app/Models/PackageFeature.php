<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class PackageFeature extends Model
{
    use HasFactory, LogsActivity, HasTranslations;

    protected $guarded = [];
    public $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Paquete característica')
        ->setDescriptionForEvent(fn(string $eventName) => "Una característica de un paquete ha sido  {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function packages(){
        return $this->belongsToMany(Package::class);
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
