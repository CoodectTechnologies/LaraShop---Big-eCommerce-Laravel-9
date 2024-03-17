<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $hidden = ['payload'];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function scopeGuests($query){
        return $query->whereNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(config('session.lifetime'))));
    }
    public function scopeRegistered($query){
        return $query->whereNotNull('user_id')->where('last_activity', '>=', strtotime(Carbon::now()->subMinutes(config('session.lifetime'))))->with('user');
    }
    public function isExpired(){
        return $this->last_activity < Carbon::now()->subMinutes(config('session.lifetime'))->getTimestamp();
    }
    public function lastSession(){
        return 'N/A';
        if($this->last_activity):
            return Carbon::parse($this->last_activity)->format('Y-m-d h:i:s');
        else:
            return 'N/A';
        endif;
    }
}
