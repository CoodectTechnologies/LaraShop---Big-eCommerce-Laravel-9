<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasFactory, LogsActivity, HasTranslations;

    protected $guarded = [];
    public $translatable = ['information', 'mission', 'vision', 'values'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Nosotros')
        ->setDescriptionForEvent(fn(string $eventName) => "Información de nosotros ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
}
