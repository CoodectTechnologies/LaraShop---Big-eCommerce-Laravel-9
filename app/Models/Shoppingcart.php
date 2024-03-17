<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'identifier';
    protected $table = 'shoppingcart';
}
