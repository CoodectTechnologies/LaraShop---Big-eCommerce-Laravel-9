<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Comentario')
        ->setDescriptionForEvent(fn(string $eventName) => "Un comentario ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function commentable(){
        return $this->morphTo();
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function reactions(){
        return $this->morphMany(Reaction::class, 'reactionable');
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
