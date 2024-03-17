<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class ConfiguratorStage extends Model
{
    use HasFactory, LogsActivity, HasTranslations, HasRelationships;

    const TYPE_COMPONENT = 'Componentes';
    const TYPE_ADDON = 'Complementos';

    protected $guarded = [];
    public $translatable = ['name'];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Configurador pasos')
        ->setDescriptionForEvent(fn(string $eventName) => "Un paso del configurador ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable')->where('main', true);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function configuratorCompatibilities(){
        return $this->hasManyThrough(
            ConfiguratorCompatibility::class,
            ConfiguratorStageProduct::class,
            'id',
            'configurator_stage_id'
        );
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
}
