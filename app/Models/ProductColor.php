<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class ProductColor extends Model
{
    use HasFactory, LogsActivity, HasTranslations;

    protected $guarded = [];
    protected $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Producto color')
        ->setDescriptionForEvent(fn(string $eventName) => "Un color de producto ha sido  {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function products(){
        return $this->belongsTo(Product::class);
    }
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
    public function productSizes(){
        return $this->belongsToMany(ProductSize::class)->withPivot(['quantity']);
    }
    public function validateColorSizeSelected($sizeId){
        $productSizes = $this->productSizes()->where('relation_with_colors', 'SI')->get();
        foreach($productSizes as $size):
            if(
                $size->id == $sizeId &&
                $size->pivot->quantity > 0
            ):
                return true;
            endif;
        endforeach;
        return false;
    }
    public function imagePreview(){
        $image = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->images()->count()):
            $image = $this->images()->first();
            if(Storage::exists($image->url)):
                $image = Storage::url($image->url);
            else:
                $image = $image->url;
            endif;
        endif;
        return $image;
    }
    public function getIsInStock(){
        $isInStock = false;
        if(count($this->productSizes)):
            foreach($this->productSizes as $productSize):
                if($productSize->pivot->quantity):
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
