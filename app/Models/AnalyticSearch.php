<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticSearch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
