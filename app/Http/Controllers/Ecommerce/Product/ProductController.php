<?php

namespace App\Http\Controllers\Ecommerce\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        return view('ecommerce.product.index');
    }
    public function show(Product $product){
        $productsViewRecents = Product::getViewRecents();
        $this->addToViewRecent($product->id);
        views($product)->cooldown(now()->addHours(1))->record();
        return view('ecommerce.product.show', compact('product', 'productsViewRecents'));
    }
    private function addToViewRecent($id){
        $coockie = "product-view-recents"; //Nombre de cookie
        $minutesOfLifeCookie = 10080; // 1 Semana
        $productViewRecents = [];
        $limitProductsToSave = 10;
        if(isset($_COOKIE[$coockie])):
            $productViewRecents = json_decode($_COOKIE[$coockie]);
            setcookie($coockie, "", time() - 1, '/');
            unset($_COOKIE[$coockie]);
            if(!in_array($id, $productViewRecents)):
                if(count($productViewRecents) >= $limitProductsToSave):
                    array_shift($productViewRecents);
                endif;
                $productViewRecents[] = $id;
            endif;
        else:
            $productViewRecents[] = $id;
        endif;
        setcookie($coockie, json_encode($productViewRecents), time() + ($minutesOfLifeCookie * 60), '/');
    }
}
