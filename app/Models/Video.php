<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Video extends Model
{
    const PLATFORM_YOUTUBE = 'YouTube';
    const PLATFORM_VIMEO = 'Vimeo';
    const PLATFORM_LOCAL = 'Local';

    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Video')
        ->setDescriptionForEvent(fn(string $eventName) => "Un video ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function videoPreview(){
        $video = asset('assets/admin/media/video/blank-video.mp4');
        if($this->video):
            if(Storage::exists($this->video)):
                $video = Storage::url($this->video);
            else:
                $video = $this->video;
            endif;
        endif;
        return $video;
    }
    public function getIframe(){
        $iframe = '';
        if(in_array($this->platform, [self::PLATFORM_YOUTUBE, self::PLATFORM_VIMEO])):
            $iframe = $this->iframe;
        elseif($this->platform == self::PLATFORM_LOCAL):
            $iframe = '<video class="img-fluid rbtplayer" playsinline controls src="'.$this->videoPreview().'"></video>';
            // $iframe = '<iframe width="100%" height="100%" src="'.$this->videoPreview().'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        endif;
        return $iframe;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
