<?php

namespace App\Http\Controllers\Ecommerce\Feed;

use App\Http\Controllers\Admin\Catalog\Feed\Facebook as FeedFacebook;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FacebookController extends Controller
{
    private $feedFacebook;

    public function __construct(){
        $this->feedFacebook = new FeedFacebook;
    }
    public function index(){
        //Get currency by default\
        $currencyCode = Currency::where('default', true)->first()->code;
        //Set options
        $this->feedFacebook->setTitle('Shopping META');
        $this->feedFacebook->setDescription('Shopping META of '.config('app.name'));
        $this->feedFacebook->setLink(config('app.url'));
        $this->feedFacebook->setCurrency($currencyCode);
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
            $this->feedFacebook->addItem(
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
                $product_type = count($product->productCategories) ? $product->productCategories()->first()->name : '',
            );
        endforeach;
        return $this->feedFacebook->display();
    }
}
