<?php

namespace App\Http\Controllers\Ecommerce\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(){
        $bannersPrimary = Banner::whereRelation('moduleWeb', 'name', 'Ecommerce - Inicio')->with('image')->orderBy('order')->get();
        $bannersSecondary = Banner::whereRelation('moduleWeb', 'name', 'Ecommerce - Inicio - mini')->orderBy('order')->get();
        $productsFeatured = Product::query()->validateProduct()->withRelations()->where('featured', true)->take(10)->get();
        $productsMostSelled = Product::query()->validateProduct()->mostSelled()->withRelations()->take(10)->get();
        $productsNew = Product::query()->validateProduct()->withRelations()->orderByDesc('id')->take(10)->get();
        $productsViewRecents = Product::getViewRecents();
        $partners = Cache::get('partners') ?? [];
        $categoriesFhater = ProductCategory::getCache()
        ->filter(function($item){
            return
            $item->productsCount > 0 &&
            !empty($item->childrens) &&
            is_null($item->parent_id);
        })
        ->shuffle()
        ->take(2)
        ->map(function ($item){
            $productCategory = ProductCategory::find($item->id);
            if($productCategory):
                $categoriesIds = ProductCategory::getCacheAllChildrenIds($productCategory->id);
                $products = Product::withRelations()->whereHas('productCategories', function($query) use($categoriesIds){
                    $query->whereIn('product_category_id', $categoriesIds);
                })
                ->take(10)
                ->get();
                $item->products = $products;
            endif;
            return $item;
        });
        return view('ecommerce.home.index', compact('bannersPrimary', 'bannersSecondary', 'productsFeatured', 'productsMostSelled', 'partners', 'categoriesFhater', 'productsViewRecents', 'productsNew'));
    }
}
