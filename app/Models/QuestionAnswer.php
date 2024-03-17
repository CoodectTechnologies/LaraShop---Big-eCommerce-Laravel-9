<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class QuestionAnswer extends Model
{
    use HasFactory, LogsActivity, HasTranslations;

    protected $guarded = [];
    public $translatable = ['question', 'answer'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Pregunta y respuesta')
        ->setDescriptionForEvent(fn(string $eventName) => "Un pregunta y respuesta ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function getDescriptionForEvent(string $eventName): string {
        return "Un pregunta y respuesta ha sido {$eventName}";
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
