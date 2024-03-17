<?php

namespace App\Http\Livewire\Ecommerce\Product;

use App\Models\AnalyticSearch;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductGender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Stevebauman\Location\Facades\Location;

class Index extends Component
{
    use WithPagination;

    public $perPage = 12;
    protected $paginationTheme = 'bootstrap';

    //Filters
    public $search;
    public $searchCustom;
    public $orderBy;
    public $category;
    public $categories = [];
    public $brand;
    public $gender;
    public $minPrice;
    public $maxPrice;
    public $type;
    public $promotions;

    protected $queryString = [
        'search' => ['except' => ''],
        'searchCustom' => ['except' => ''],
        'orderBy' => ['except' => ''],
        'category' => ['except' => ''],
        'brand' => ['except' => ''],
        'gender' => ['except' => ''],
        'minPrice' => ['except' => ''],
        'maxPrice' => ['except' => ''],
        'type' => ['except' => ''],
        'promotions' => ['except' => ''],
    ];

    public function mount(Request $request){
        $this->loadRequestFilter($request);
    }
    public function render(){
        $banners = Banner::whereRelation('moduleWeb', 'name', 'Ecommerce - Productos')->get();
        $bannersSidebar = Banner::whereRelation('moduleWeb', 'name', 'Ecommerce - Productos sidebar')->get();
        $productCategories = ProductCategory::with('products')->get();
        $productBrands = ProductBrand::with('products')->get();
        $productGenders = ProductGender::with('products')->get();
        $products = $this->getProducts();
        $productCategories = $this->getCategories();
        return view('livewire.ecommerce.product.index', compact('banners', 'bannersSidebar', 'products', 'productCategories', 'productBrands', 'productGenders'));
    }
    private function getProducts(){
        $products = Product::withRelations()->validateProduct();
        $products = $this->filters($products);
        $products = $products->paginate($this->perPage);
        return $products;
    }
    private function getCategories(){
        if($this->category):
            $productCategories = collect();
            $productCategory = ProductCategory::getCache()->where('slug', $this->category)->first();
            if(isset($productCategory->childrens) && count($productCategory->childrens)):
                $productCategories = $productCategory->childrens;
            endif;
            return $productCategories;
        else:
            $productCategories = ProductCategory::getCache()->where('parent_id', null);
            return $productCategories;
        endif;
    }
    public function filters($products){
        if($this->search || $this->searchCustom):
            $search = $this->searchCustom ?? $this->search;
            if($this->searchCustom):
                $this->search = null;
            endif;
            $products = $products->where(function($query) use($search){
                $query->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('sku', 'LIKE', "%{$search}%")
                ->orWhere('detail', 'LIKE', "%{$search}%")
                ->orWhere('search_advanced', 'LIKE', "%{$search}%");
            });
            if($this->search):
                $products = $products->orWhere(function($query){
                    $query->whereRelation('productCategories', 'name', 'LIKE', "%{$this->search}%")
                    ->whereRelation('productGenders', 'name', 'LIKE', "%{$this->search}%")
                    ->whereRelation('productBrand', 'name', 'LIKE', "%{$this->search}%");
                });
                $this->saveAnalyticSearch($products, $this->search);
            endif;
        endif;
        if(count($this->categories)):
            $allChildrenIds = [];
            $categories = ProductCategory::whereIn('slug', $this->categories)->get();
            foreach($categories as $category):
                array_push($allChildrenIds, ProductCategory::getCacheAllChildrenIds($category->id));
            endforeach;
            $allChildrenIds = call_user_func_array('array_merge', $allChildrenIds);
            $allChildrenIds = array_unique($allChildrenIds);
            $products = $products->whereHas('productCategories', function($query) use($allChildrenIds){
                $query->whereIn('product_category_id', $allChildrenIds);
            });
        else:
            if($this->category):
                $allChildrenIds = [];
                $category = ProductCategory::where('slug', $this->category)->first();
                $allChildrenIds = ProductCategory::getCacheAllChildrenIds($category->id);
                $products = $products->whereHas('productCategories', function($query) use($allChildrenIds){
                    $query->whereIn('product_category_id', $allChildrenIds);
                });
            endif;
        endif;
        if($this->brand):
            $products = $products->whereRelation('productBrand', 'slug', $this->brand);
        endif;
        if($this->gender):
            $products = $products->whereRelation('productGenders', 'slug', $this->gender);
        endif;
        if($this->orderBy):
            if($this->orderBy == 'featured'):
                $products = $products->where('featured', true);
            endif;
            if($this->orderBy == 'nameASC'):
                $products = $products->orderBy('name');
            endif;
            if($this->orderBy == 'nameDESC'):
                $products = $products->orderByDesc('name');
            endif;
            if($this->orderBy == 'price-low'):
                $products = $products->orderBy('price');
            endif;
            if($this->orderBy == 'price-high'):
                $products = $products->orderByDesc('price');
            endif;
        else:
            $products = $products->orderBy('id', 'desc');
        endif;
        if($this->minPrice):
            $products = $products->where('price', '>=', $this->minPrice);
        endif;
        if($this->maxPrice):
            $products = $products->where('price', '<=', $this->maxPrice);
        endif;
        if($this->type):
            $products = $products->where('type', $this->type);
        endif;
        if($this->promotions):
            $products = $products->hasPromotions();
        endif;
        return $products;
    }
    public function filterPrice($minPrice = null, $maxPrice = null){
        $this->minPrice = (double) $minPrice;
        $this->maxPrice = (double) $maxPrice;
    }
    public function existAnyFilter(){
        $existAnyFilter = false;
        if(
            $this->search ||
            $this->category ||
            count($this->categories) ||
            $this->brand ||
            $this->orderBy ||
            $this->minPrice ||
            $this->maxPrice
        ):
            $existAnyFilter = true;
        endif;
        return $existAnyFilter;
    }
    public function clearFilter(){
        $this->reset('search', 'category', 'categories', 'brand', 'orderBy', 'minPrice', 'maxPrice');
    }
    private function saveAnalyticSearch($products, $search){
        $founded = false;
        $search = htmlspecialchars(addslashes($search));
        if($products->count()) $founded = true;
        $data = Location::get(request()->ip());
        AnalyticSearch::create([
            'search' => $search,
            'founded' => $founded,
            'data' => json_encode($data)
        ]);
    }
    private function loadRequestFilter($request){
        if($request->search):
            $this->search = $request->search;
        endif;
        if($request->orderBy):
            $this->orderBy = $request->orderBy;
        endif;
        if($request->category):
            $this->category = $request->category;
        endif;
        if($request->brand):
            $this->brand = $request->brand;
        endif;
        if($request->gender):
            $this->gender = $request->gender;
        endif;
        if($request->minPrice):
            $this->minPrice = (double) $request->minPrice;
        endif;
        if($request->maxPrice):
            $this->maxPrice = (double) $request->maxPrice;
        endif;
        if($request->type):
            $this->type = $request->type;
        endif;
        if($request->promotions):
            $this->promotions = $request->promotions;
        endif;
    }
    public function updatingCategories($categories){
        $this->resetPage();
    }
}
