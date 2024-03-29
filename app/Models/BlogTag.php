<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class BlogTag extends Model
{
    use HasFactory, LogsActivity, HasTranslations;

    protected $guarded = [];
    public $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Blog Etiquetas')
        ->setDescriptionForEvent(fn(string $eventName) => "Una etiqueta de blog ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function blogPosts(){
        return $this->belongsToMany(BlogPost::class);
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
