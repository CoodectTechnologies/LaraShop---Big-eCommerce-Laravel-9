<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Promotion extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Promoción')
        ->setDescriptionForEvent(fn(string $eventName) => "Una promoción ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function currencies(){
        return $this->belongsToMany(Currency::class)->withTimestamps();
    }
    public function products(){
        return $this->morphedByMany(Product::class, 'promotionable')->withTimestamps();
    }
    public function productCategories(){
        return $this->morphedByMany(ProductCategory::class, 'promotionable')->withTimestamps();
    }
    public function productBrands(){
        return $this->morphedByMany(ProductBrand::class, 'promotionable')->withTimestamps();
    }
    //TOOLS
    public function dateStartToString(){
        return Carbon::parse($this->date_start)->toFormattedDateString();
    }
    public function dateEndToString(){
        return Carbon::parse($this->date_end)->toFormattedDateString();
    }
    //Gets
    public static function getPromotionProduct(Product $product){
        $oPromotion = null;
        $promotions = self::query()
        ->whereHas('currencies', function($query){ $query->where('code', Session::get('currency')); })
        ->where('active', true)
        ->whereDate('date_start', '<=', date('Y-m-d'))
        ->whereDate('date_end', '>', date('Y-m-d'))
        ->orderByDesc('id')
        ->get();
        foreach($promotions as $promotion):
            switch($promotion->type):
                case 'Todos':
                    $oPromotion = $promotion;
                    break;
                case 'Producto':
                    $productId = $product->id;
                    $products = $promotion->products();
                    if($promotion->conditional == 'Que sean'):
                        $products->whereIn('promotionable_id', [$productId]);
                    elseif($promotion->conditional == 'Que no sean'):
                        $products->whereNotIn('promotionable_id', [$productId]);
                    endif;
                    $products = $products->count();
                    if($products):
                        $oPromotion = $promotion;
                    endif;
                    break;
                case 'Categoría':
                    $categoryIds = $product->productCategories()->pluck('product_category_id')->toArray();
                    $productCategories = $promotion->productCategories();
                    if($promotion->conditional == 'Que sean'):
                        $productCategories = $productCategories->whereIn('promotionable_id', $categoryIds);
                    elseif($promotion->conditional == 'Que no sean'):
                        $productCategories = $productCategories->whereNotIn('promotionable_id', $categoryIds);
                    endif;
                    $productCategories = $productCategories->count();
                    if($productCategories):
                        $oPromotion = $promotion;
                    endif;
                    break;
                case 'Marca':
                    $brandId = $product->product_brand_id;
                    $productBrands = $promotion->productBrands();
                    if($promotion->conditional == 'Que sean'):
                        $productBrands->whereIn('promotionable_id', [$brandId]);
                    elseif($promotion->conditional == 'Que no sean'):
                        $productBrands->whereNotIn('promotionable_id', [$brandId]);
                    endif;
                    $productBrands = $productBrands->count();
                    if($productBrands):
                        $oPromotion = $promotion;
                    endif;
                    break;
            endswitch;
        endforeach;
        return $oPromotion;
    }
}
