<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguratorBudgetProduct extends Model
{
    use HasFactory;

    protected $table = 'configurator_budget_configurator_stage_product';
    protected $guarded = [];
}
