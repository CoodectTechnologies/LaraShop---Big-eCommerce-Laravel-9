<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TagAnalytic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getCache(){
        $tagAnalytic = new TagAnalytic();
        if(Cache::get('tagAnalytic')):
            $tagAnalytic = Cache::get('tagAnalytic');
        else:
            $tagAnalyticTMP = TagAnalytic::first();
            if($tagAnalyticTMP):
                $tagAnalytic = $tagAnalyticTMP;
                Cache::put('tagAnalytic', $tagAnalytic);
            endif;
        endif;
        return $tagAnalytic;
    }
}
