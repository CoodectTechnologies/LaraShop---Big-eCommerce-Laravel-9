<?php

namespace App\Http\Controllers\Ecommerce\Account\ProductDigital;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDigitalController extends Controller
{
    public function index(){
        return view('ecommerce.account.product-digital.index');
    }
    public function show(Product $product){
        return view('ecommerce.account.product-digital.show', compact('product'));
    }
}
