<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ModuleWeb extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Módulo web')
        ->setDescriptionForEvent(fn(string $eventName) => "Un módulo web ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function banners(){
        return $this->hasMany(Banner::class);
    }
    public function galleries(){
        return $this->hasMany(Gallery::class);
    }
    public function videos(){
        return $this->hasMany(Video::class);
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
