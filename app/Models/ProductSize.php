<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Translatable\HasTranslations;

class ProductSize extends Model
{
    use HasFactory, LogsActivity, HasTranslations;

    protected $guarded = [];
    public $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Producto medidas')
        ->setDescriptionForEvent(fn(string $eventName) => "Una medida de producto ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function productColors(){
        return $this->belongsToMany(ProductColor::class)->withPivot(['quantity']);
    }
    public function validateSizeColorSelected($colorId){
        foreach($this->productColors as $color):
            if(
                $color->id == $colorId &&
                $color->quantity > 0
            ):
                return true;
            endif;
        endforeach;
        return false;
    }
    //Gets
    public function getPriceToString(){
        $sessionCurrency = Session::get('currency');
        $priceToString = '$'.number_format($this->getPrice(), 2).' '.$sessionCurrency;
        if($pricePromotion = $this->getPricePromotion()):
            $pricePromotion = '$'.number_format($pricePromotion, 2).' '.$sessionCurrency;
            $priceToString = '<del class="old-price">'.$priceToString.'</del> '.'<ins class="new-price">'.$pricePromotion.'</ins>';
        endif;
        return $priceToString;
    }
    public function getPrice(){
        $price = $this->price;
        $currency = Currency::validate()->where('code', Session::get('currency'))->first();
        if($currency && $currency->value):
            $price = round($price / $currency->value, 2);
        endif;
        return $price;
    }
    public function getPricePromotion(){
        $pricePromotion = 0;
        if($promotion = Promotion::getPromotionProduct($this->product)):
            if($promotion->include_to_variant):
                $price = $this->getPrice();
                $pricePromotion = ($price - ((($promotion->percentage / 100)) * $price));
            endif;
        endif;
        return $pricePromotion;
    }
    public function getPriceFinal(){
        $priceFinal = 0;
        if($pricePromotion = $this->getPricePromotion()):
            $priceFinal = $pricePromotion;
        else:
            $priceFinal = $this->getPrice();
        endif;
        return $priceFinal;
    }
    public function getIsInStock(){
        $isInStock = false;
        if(count($this->productColors)):
            foreach($this->productColors as $productColor):
                if($productColor->pivot->quantity):
                    $isInStock = true;
                endif;
            endforeach;
        else:
            $isInStock = ($this->quantity > 0);
        endif;
        return $isInStock;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
