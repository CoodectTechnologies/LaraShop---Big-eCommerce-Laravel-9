<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguratorStageProduct extends Model
{
    use HasFactory;

    protected $table = 'configurator_stage_product';

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function configuratorStage(){
        return $this->belongsTo(ConfiguratorStage::class);
    }
}
