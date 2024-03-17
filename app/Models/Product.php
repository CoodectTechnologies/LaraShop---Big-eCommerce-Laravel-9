<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements Viewable
{
    use HasFactory, Sluggable, LogsActivity, InteractsWithViews, HasTranslations;

    const TYPE_PHYSICAL = 'Físico';
    const TYPE_DIGITAL = 'Digital';
    const TYPE_PHYSICAL_AND_DIGITAL = 'Físico y Digital';
    const STOCK_LOW = 5;

    protected $guarded = [];
    protected $removeViewsOnDelete = true;
    public $translatable = ['name', 'detail', 'description', 'search_advanced', 'meta_title', 'meta_description', 'meta_keywords'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Producto')
        ->setDescriptionForEvent(fn(string $eventName) => "Un producto ha sido  {$eventName}")
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
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable')->where('main', true);
    }
    public function images(){
        return $this->morphMany(Image::class, 'imageable')->whereNull('main');
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function promotions(){
        return $this->morphToMany(Promotion::class, 'promotionable')->withTimestamps();
    }
    public function wholesales(){
        return $this->belongsToMany(Wholesale::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withTimestamps()->withPivot(['product_size_id', 'product_color_id', 'color', 'size', 'type', 'quantity', 'price', 'subtotal', 'created_at']);
    }
    public function productGenders(){
        return $this->belongsToMany(ProductGender::class);
    }
    public function productSizes(){
        return $this->hasMany(ProductSize::class);
    }
    public function productColors(){
        return $this->hasMany(ProductColor::class);
    }
    public function productSimilars(){
        return $this->hasMany(ProductSimilar::class)->with('product');
    }
    public function productCategories(){
        return $this->belongsToMany(ProductCategory::class);
    }
    public function productBrand(){
        return $this->belongsTo(ProductBrand::class);
    }
    public function shippingClass(){
        return $this->belongsTo(ShippingClass::class);
    }
    public function configuratorStages(){
        return $this->belongsToMany(ConfiguratorStage::class);
    }
    public function configuratorCompatibilities(){
        return $this->belongsToMany(ConfiguratorCompatibility::class);
    }
    //Gets
    public function viewUniques(){
        return views($this)->unique()->count();
    }
    public function getPromotion(){
        $promotion = Promotion::getPromotionProduct($this);
        if($promotion):
            $price = $this->getPrice();
            $this->promotion_price = ($price - ((($promotion->percentage / 100)) * $price));
            $this->promotion_percentage = $promotion->percentage;
        else:
            $this->promotion_price = 0;
            $this->promotion_percentage = 0;
        endif;
        return $promotion;
    }
    public function getWholesale(){
        return Wholesale::getWholesale($this);
    }
    public function getPriceToString(){
        $sessionCurrency = Session::get('currency');
        $priceToString = '<ins class="new-price">'.'$'.number_format($this->getPrice(), 2).' '.$sessionCurrency.'</ins>';
        if($pricePromotion = $this->getPricePromotion()):
            $pricePromotion = '<ins class="new-price">'.'$'.number_format($pricePromotion, 2).' '.$sessionCurrency.'</ins>';
            $priceToString = '<del class="old-price">'.$priceToString.'</del> '.$pricePromotion;
        else:
            $priceMaxSize = $this->getPriceSizeMax();
            if($priceMaxSize):
                $priceMaxSize = '$'.number_format($priceMaxSize, 2).' '.$sessionCurrency;
                $priceToString = $priceToString.' - '.$priceMaxSize;
            endif;
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
        if(!isset($this->promotion_percentage)):
            $this->getPromotion();
        endif;
        if($this->promotion_percentage > 0):
            $pricePromotion = ($this->price - ((($this->promotion_percentage / 100)) * $this->price));
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
    public function getPriceSizeMax(){
        $sessionCurrency = Session::get('currency');
        $currency = Currency::validate()->where('code', $sessionCurrency)->first();
        $priceMaxSize = 0;
        $productSizes = $this->productSizes()->get();
        foreach($productSizes as $productSize):
            if($priceMaxSize <= $productSize->price):
                $priceMaxSize = $productSize->price;
            endif;
        endforeach;
        if($currency && $currency->value):
            $priceMaxSize = $priceMaxSize / $currency->value;
        endif;
        return $priceMaxSize;
    }
    public function getStatusToString(){
        if($this->status == 'Borrador'):
            return '<div class="badge badge-light-warning">'.$this->status.'</div>';
        elseif($this->status == 'Publicado'):
            return '<div class="badge badge-light-success">'.$this->status.'</div>';
        else:
            return '<div class="badge badge-light-danger">Desconocido</div>';
        endif;
    }
    public function getIsNew(){
        $isNew = false;
        $daysExpiredNew = 7; //Si un producto llega a los 7 días de ser creado, ya no será considerado nuevo
        $diffTime = Carbon::parse($this->created_at)->diffInDays(date('Y-m-d'));
        if($diffTime <= $daysExpiredNew):
            $isNew = true;
        endif;
        return $isNew;
    }
    public function getIsInStock(){
        $isInStock = false;
        if($this->quantity > 0 || $this->quantity === null):
            $isInStock = true;
            return $isInStock;
        endif;
        if(count($this->productSizes)):
            foreach($this->productSizes as $productSize):
                if($productSize->getIsInStock()):
                    $isInStock = true;
                    return $isInStock;
                endif;
            endforeach;
        endif;
        if(count($this->productColors)):
            foreach($this->productColors as $productColor):
                if($productColor->getIsInStock()):
                    $isInStock = true;
                    return $isInStock;
                endif;
            endforeach;
        endif;
        return $isInStock;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
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
        $starsAVG = 5;
        $commentStars = $this->comments->sum('stars');
        $commentCounts = $this->comments->count();
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
        $commentsTotal = $this->comments->count();
        $commentCounts = $this->comments->where('stars', $qty)->count();
        if($commentCounts):
            $starsPercentage = ($commentCounts * 100) / $commentsTotal;
        endif;
        return floor($starsPercentage);
    }
    public function getIsPhysical(){
        return ($this->type == self::TYPE_PHYSICAL || $this->type == self::TYPE_PHYSICAL_AND_DIGITAL || !$this->type) ? true : false;
    }
    public function getIsDigital(){
        return ($this->type == self::TYPE_DIGITAL || $this->type == self::TYPE_PHYSICAL_AND_DIGITAL) ? true : false;
    }
    public function getType(){
        return $this->type ?? Product::TYPE_PHYSICAL;
    }
    public function getIsDownloadable(){
        return ($this->getIsDigital() && $this->downloadable) ? true : false;
    }
    public function getFileDigital(){
        $fileDigital = '';
        if($this->file_digital):
            if(Storage::exists($this->file_digital)):
                $fileDigital = Storage::url($this->file_digital);
            else:
                $fileDigital = $this->file_digital;
            endif;
        endif;
        return $fileDigital;
    }
    public static function getViewRecents(){
        //Extraer ids by cookie
        $products = [];
        $coockie = "product-view-recents"; //Nombre de cookie
        if(isset($_COOKIE[$coockie])):
            $productIds = json_decode($_COOKIE[$coockie]);
            $products = self::with(['image', 'comments'])->whereIn('id', $productIds)->get();
        endif;
        return $products;
    }
    public static function getTypes(){
        return [self::TYPE_PHYSICAL, self::TYPE_DIGITAL, self::TYPE_PHYSICAL_AND_DIGITAL];
    }
    //Scopes
    public function scopeValidateProduct($query){
        return $query->where('status', 'Publicado');
    }
    public function scopeMostSelled($query){
        $productsIds = Product::has('orders')->with('orders')->get()->sortBy(function($query) {
            return $query->orders->sum('quantity');
        })->take(10)->pluck('id');
        return $query->whereIn('id', $productsIds);
    }
    public function scopeWithRelations($query){
        return $query->with(['image', 'images.image', 'productCategories'])
        ->with(['comments' => function($query){
            $query->validate();
        }]);
    }
    public function scopeHasPromotions($query){
        $productInIds = [];
        $productNotInIds = [];
        $categoryInIds = [];
        $categoryNotInIds = [];
        $brandInIds = [];
        $brandNotInIds = [];
        $promotions = Promotion::query()
        ->with(['productCategories', 'productBrands', 'products'])
        ->where('active', true)
        ->whereHas('currencies', function($query){ $query->where('code', Session::get('currency')); })
        ->whereDate('date_start', '<=', date('Y-m-d'))
        ->whereDate('date_end', '>', date('Y-m-d'))
        ->orderByDesc('id')
        ->get();
        if(count($promotions)):
            foreach($promotions as $promotion):
                # BY TODO
                if($promotion->type == 'Todos'):
                    return $query;
                endif;
                # BY PRODUCT
                if(
                    $promotion->type == 'Producto' &&
                    count($promotion->products)
                ):
                    foreach($promotion->products as $product):
                        if($promotion->conditional == 'Que sean'):
                            $productInIds[$product->id] = $product->id;
                        else:
                            $productNotInIds[$product->id] = $product->id;
                        endif;
                    endforeach;
                endif;
                # BY CATEGORIES
                if(
                    $promotion->type == 'Categoría' &&
                    count($promotion->productCategories)
                ):
                    foreach($promotion->productCategories as $productCategory):
                        if($promotion->conditional == 'Que sean'):
                            $categoryInIds[$productCategory->id] = $productCategory->id;
                        else:
                            $categoryNotInIds[$productCategory->id] = $productCategory->id;
                        endif;
                    endforeach;
                endif;
                # BY BRAND
                if(
                    $promotion->type == 'Marca' &&
                    count($promotion->productBrands)
                ):
                    foreach($promotion->productBrands as $productBrand):
                        if($promotion->conditional == 'Que sean'):
                            $categoryInIds[$productBrand->id] = $productBrand->id;
                        else:
                            $categoryNotInIds[$productBrand->id] = $productBrand->id;
                        endif;
                    endforeach;
                endif;
            endforeach;
            # BY PRODUCT
            if(count($productInIds)):
                $query->whereIn('id', array_keys($productInIds));
            endif;
            if(count($productNotInIds)):
                $query->whereNotIn('id', array_keys($productNotInIds));
            endif;
            # BY CATEGORIES
            if(count($categoryInIds)):
                if(count($productInIds) || count($productNotInIds)):
                    $query->orWhere(function($query) use($categoryInIds){
                        $this->_scopePromotionByCategories($query, 'in', $categoryInIds);
                    });
                else:
                    $query->where(function($query) use($categoryInIds){
                        $this->_scopePromotionByCategories($query, 'in', $categoryInIds);
                    });
                endif;
            endif;
            if(count($categoryNotInIds)):
                if(count($productInIds) || count($productNotInIds)):
                    $query->orWhere(function($query) use($categoryNotInIds){
                        $this->_scopePromotionByCategories($query, 'not_in', $categoryNotInIds);
                    });
                else:
                    $query->where(function($query) use($categoryNotInIds){
                        $this->_scopePromotionByCategories($query, 'not_in', $categoryNotInIds);
                    });
                endif;
            endif;
            # BY BRAND
            if(count($brandInIds)):
                if(count($productInIds) || count($productNotInIds)):
                    $query->orWhere(function($query) use($brandInIds){
                        $this->_scopePromotionByBrands($query, 'in', $brandInIds);
                    });
                else:
                    $query->where(function($query) use($brandInIds){
                        $this->_scopePromotionByBrands($query, 'in', $brandInIds);
                    });
                endif;
            endif;
            if(count($brandNotInIds)):
                if(count($productInIds) || count($productNotInIds)):
                    $query->orWhere(function($query) use($brandNotInIds){
                        $this->_scopePromotionByBrands($query, 'not_in', $brandNotInIds);
                    });
                else:
                    $query->where(function($query) use($brandNotInIds){
                        $this->_scopePromotionByBrands($query, 'not_in', $brandNotInIds);
                    });
                endif;
            endif;
        else:
            $query->has('promotions')->whereHas('promotions', function($query){
                $query->where('active', true);
            });
        endif;
        return $query;
    }
    //Tools partial scopes
    private function _scopePromotionByCategories($query, $type, $categoryIds){
        $query->whereHas('productCategories', function($query) use($type, $categoryIds){
            if ($type == 'in'):
                $query->whereIn('product_category_id', array_keys($categoryIds));
            else:
                $query->whereNotIn('product_category_id', array_keys($categoryIds));
            endif;
        });
        return $query;
    }
    private function _scopePromotionByBrands($query, $type, $brandInIds){
        if ($type == 'in'):
            $query->whereIn('product_brand_id', array_keys($brandInIds));
        else:
            $query->whereNotIn('product_brand_id', array_keys($brandInIds));
        endif;
        return $query;
    }
}
