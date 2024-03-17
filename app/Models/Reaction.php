<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    const LIKE = "Like";
    const DISLIKE = "Dislike";

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reactionable(){
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
}
