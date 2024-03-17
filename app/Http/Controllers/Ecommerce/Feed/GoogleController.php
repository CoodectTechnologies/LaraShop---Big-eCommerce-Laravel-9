<?php

namespace App\Http\Controllers\Ecommerce\Feed;

use App\Http\Controllers\Admin\Catalog\Feed\Google as FeedGoogle;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GoogleController extends Controller
{
    private $feedGoogle;

    public function __construct(){
        $this->feedGoogle = new FeedGoogle;
    }
    public function index(){
        //Get currency by default
        $currencyCode = Currency::where('default', true)->first()->code;
        //Set options
        $this->feedGoogle->setTitle('Shopping GOOGLE');
        $this->feedGoogle->setDescription('Shopping GOOGLE of '.config('app.name'));
        $this->feedGoogle->setLink(config('app.url'));
        $this->feedGoogle->setCurrency($currencyCode);
        //Get products
        $products = Product::query()
        ->with(['image', 'productCategories'])
        ->validateProduct()
        ->whereHas('currencies', function($query) use($currencyCode) {
            $query->where('code', $currencyCode);
        })
        ->get();
        //Build products
        foreach($products as $product):
            $this->feedGoogle->addItem(
                $id = $product->id,
                $availability = $product->quantity,
                $condition = 'New',
                $description = $product->detail,
                $image_link	= config('app.url').$product->imagePreview(),
                $link = route('ecommerce.product.show', $product),
                $title = $product->name,
                $price = $product->getPriceFinal(),
                $brand = $product->productBrand ? $product->productBrand->name : '',
                //Optional
                $google_product_category = count($product->productCategories) ? $product->productCategories()->first()->name : '',
            );
        endforeach;
        return $this->feedGoogle->display();
    }
}
