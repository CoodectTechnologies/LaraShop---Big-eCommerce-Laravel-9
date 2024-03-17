<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Review extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Review')
        ->setDescriptionForEvent(fn(string $eventName) => "Una review ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reviewable(){
        return $this->morphTo();
    }
    //Gets
    public function imageUserPreview(){
        $image = asset('assets/admin/media/avatars/blank.png');
        if($this->user):
            $image = $this->user->imagePreview();
        endif;
        return $image;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    public function getPercentage(){
        return ($this->stars * 100) / 5;
    }
    //Scope
    public function scopeValidate($query){
        return $query->where('approved', true);
    }
}
