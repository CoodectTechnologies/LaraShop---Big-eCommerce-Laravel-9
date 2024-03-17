<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Wholesale extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Mayoreo')
        ->setDescriptionForEvent(fn(string $eventName) => "Un registro de mayoreo ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function wholesaleDetails(){
        return $this->hasMany(WholesaleDetail::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
    public function currencies(){
        return $this->belongsToMany(Currency::class)->withTimestamps();
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    //Gets
    public static function getWholesale(Product $product){
        $oWholesale = null;
        $wholesales = self::query()
        ->with('products')
        ->whereHas('currencies', function($query){ $query->where('code', Session::get('currency')); })
        ->orderByDesc('id')
        ->get();
        foreach($wholesales as $wholesale):
            switch($wholesale->type):
                case 'Todos':
                    $oWholesale = $wholesale;
                    break;
                case 'Producto':
                    $products = $wholesale->products()->whereIn('product_id', [$product->id])->count();
                    if($products):
                        $oWholesale = $wholesale;
                    endif;
                    break;
            endswitch;
        endforeach;
        return $oWholesale;
    }
}
