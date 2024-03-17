<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model implements Viewable
{
    use HasFactory, Sluggable, LogsActivity, InteractsWithViews, HasTranslations;

    protected $guarded = [];
    protected $removeViewsOnDelete = true;
    public $translatable = ['name', 'fragment', 'body', 'meta_title', 'meta_description', 'meta_keywords'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Blog Posts')
        ->setDescriptionForEvent(fn(string $eventName) => "Un post de blog ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function blogCategories(){
        return $this->belongsToMany(BlogCategory::class);
    }
    public function blogTags(){
        return $this->belongsToMany(BlogTag::class);
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function imagePreview(){
        $image = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->image):
            if(Storage::exists($this->image->url)):
                $image = Storage::url($this->image->url);
            else:
                $image = $this->image->url;
            endif;
        endif;
        return $image;
    }
    public function getStarsAVG(){
        $starsAVG = 0;
        $commentStars = $this->comments()->validate()->sum('stars');
        $commentCounts = $this->comments()->validate()->count();
        if($commentStars && $commentCounts):
            $starsAVG = number_format(($commentStars / $commentCounts), 1);
        endif;
        return $starsAVG;
    }
    public function getStarsPercentageAVG(){
        $getStarsAVG = $this->getStarsAVG();
        return ($getStarsAVG * 100) / 5;
    }
    public function getStarsPercentage($qty){
        $starsPercentage = 0;
        $commentsTotal = $this->comments()->validate()->count();
        $commentCounts = $this->comments()->where('stars', $qty)->validate()->count();
        if($commentCounts):
            $starsPercentage = ($commentCounts * 100) / $commentsTotal;
        endif;
        return floor($starsPercentage);
    }
    public function wasCommented(){
        $wasCommented = false;
        if(Auth::check()):
            $wasCommented = $this->comments()->where('user_id', Auth::id())->first() ? true : false;
        endif;
        return $wasCommented;
    }
    public function viewUniques(){
        return views($this)->unique()->count();
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
