<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class ProductCategory extends Model
{
    use HasFactory, Sluggable, LogsActivity, HasTranslations;

    protected $guarded = [];
    public $translatable = ['name', 'description'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Producto categoría')
        ->setDescriptionForEvent(fn(string $eventName) => "Una categoría de producto ha sido  {$eventName}")
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
    public function parent(){
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }
    public function childrens(){
        return $this->hasMany(ProductCategory::class, 'parent_id')->with(['image'])->with(['products' => function($query){ $query->validateProduct(); }]);
    }
    public function allChildrens(){
        return $this->childrens()->with('allChildrens');
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
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
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function promotions(){
        return $this->morphToMany(Promotion::class, 'promotionable')->withTimestamps();
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    public function getAllChildrenIds(){
        $ids = self::getIds($this);
        $ids = array_unique($ids);
        return $ids;
    }
    public static function getCacheAllChildrenIds($productCategoryId){
        $ids = self::getCacheIds($productCategoryId);
        $ids = array_unique($ids);
        return $ids;
    }
    //Scopes
    public function scopeAllProductsByCategory(){
        $allChildrenIds = $this->getAllChildrenIds();
        $products = Product::query()
        ->with('image', 'productCategories')
        ->validateProduct()
        ->whereHas('productCategories', function($query) use($allChildrenIds) {
            $query->whereIn('product_category_id', $allChildrenIds);
        })->get();
        return $products;
    }
    // Partials
    public function scopeAllChildrens($query, $productCategory){
        $ids = self::getIds($productCategory);
        $ids = array_unique($ids);
        return $query->whereIn('id', $ids);
    }
    public static function getTree($category){
        $categoryData = [
            'id' => $category->id,
            'parent_id' => $category->parent_id,
            'slug' => $category->slug,
            'name' => $category->getTranslations('name'),
            'image' => $category->image ? Storage::url($category->image->url) : null,
            'productsCount' => count($category->products)
        ];
        if($category->allChildrens->isNotEmpty()):
            $categoryData['childrens'] = $category->allChildrens->map(function ($child) {
                return self::getTree($child);
            });
        endif;
        $categoryData = (object) $categoryData;
        Cache::forever('productCategory-'.$category->id, $categoryData);
        return $categoryData;
    }
    public static function getIds($category){
        $ids = [$category->id];
        if($category->allChildrens->isNotEmpty()):
            $category->allChildrens->each(function ($child) use (&$ids){
                $ids[] = $child->id;
                if($child->allChildrens->isNotEmpty()):
                    $ids = array_merge($ids, self::getIds($child));
                endif;
            });
        endif;
        return $ids;
    }
    public static function getCacheIds($productCategoryId){
        $productCategory = self::getCache($productCategoryId);
        $ids = [$productCategoryId];
        if(isset($productCategory->childrens) && count($productCategory->childrens)):
            $productCategory->childrens->each(function ($child) use (&$ids){
                $ids[] = $child->id;
                if(isset($child->childrens) && count($child->childrens)):
                    $ids = array_merge($ids, self::getCacheIds($child->id));
                endif;
            });
        endif;
        return $ids;
    }
    public static function regenerateCache($productCategoryId = null){
        ini_set('memory_limit', '2048M');
        if($productCategoryId):
            $productCategory = ProductCategory::find($productCategoryId);
            $productCategoryTree = self::getTree($productCategory);
            Cache::forever('productCategory-'.$productCategory->id, $productCategoryTree);
        else:
            $productCategoriesCollect = collect();
            $productCategories = ProductCategory::query()
            ->with(['products' => function($query){ $query->validateProduct(); }])
            ->with(['allChildrens', 'image'])
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
            foreach ($productCategories as $productCategory):
                $productCategoryArray = self::getTree($productCategory);
                $productCategoriesCollect->push($productCategoryArray);
            endforeach;
            Cache::forever('productCategories', $productCategoriesCollect);
        endif;
    }
    public static function getCache($productCategoryId = null){
        if($productCategoryId):
            if(!Cache::has('productCategory-'.$productCategoryId)):
                self::regenerateCache($productCategoryId);
            endif;
            $productCategoryCache = Cache::get('productCategory-'.$productCategoryId);
            $productCategoryCache = self::translatableCache($productCategoryCache);
            $productCategoryCache = self::sortCache($productCategoryCache);
            return $productCategoryCache;
        else:
            if(!Cache::has('productCategories')):
                self::regenerateCache();
            endif;
            $productCategoriesCache = collect();
            foreach(Cache::get('productCategories') as $productCategoryCache):
                $productCategoryCache = self::translatableCache($productCategoryCache);
                $productCategoryCache = self::sortCache($productCategoryCache);
                $productCategoriesCache->push($productCategoryCache);
            endforeach;
            return $productCategoriesCache;
        endif;
    }
    private static function translatableCache($item) {
        $language = Session::get('language');
        $languageDefault = config('translatable.fallback');
        $formattedName = isset($item->name[$language]) ? $item->name[$language] : $item->name[$languageDefault];
        $item->name = $formattedName;
        if(isset($item->childrens) && count($item->childrens)):
            foreach($item->childrens as $key => $child):
                $item->childrens[$key] = self::translatableCache($child);
            endforeach;
        endif;
        return $item;
    }
    public static function sortCache($productCategoryCache){
        if (isset($productCategoryCache->childrens)):
            $childrensArray = $productCategoryCache->childrens->toArray();
            if (array_keys($childrensArray) !== range(0, count($childrensArray) - 1)):
                ksort($childrensArray);
            else:
                usort($childrensArray, function($a, $b) {
                    return strcasecmp($a->name, $b->name);
                });
            endif;
            foreach ($childrensArray as &$child):
                $child = self::sortCache($child);
            endforeach;
            $productCategoryCache->childrens = collect($childrensArray);
        endif;
        return $productCategoryCache;
    }
}
