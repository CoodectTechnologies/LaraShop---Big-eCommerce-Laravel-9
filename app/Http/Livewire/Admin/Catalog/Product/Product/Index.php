<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Product;

use App\Exports\Admin\Product\ProductExport;
use App\Imports\Admin\Product\ProductImport;
use App\Imports\Admin\Product\ProductWordpressImport;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $perPage = 100;
    public $search;
    public $statusFilter;
    public $stockFilter;
    public $categoryIdFilter;
    public $excelImportTmp, $excelWordpressImportTmp, $fileTmpInputId, $fileWordpressTmpInputId;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public function mount(){
        $this->loadRandomFileTmpInputId();
        $this->loadRandomFileWordpressTmpInputId();
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $categories = ProductCategory::orderBy('name')->get();
        $products = Product::query()->with(['comments', 'image', 'images', 'productCategories'])->orderBy('id', 'desc');
        if($this->search):
            $products = $products->where(function($query){
                $query->orWhere('name', 'LIKE', "%{$this->search}%")
                ->orWhere('sku', 'LIKE', "%{$this->search}%")
                ->orWhere('detail', 'LIKE', "%{$this->search}%")
                ->orWhere('search_advanced', 'LIKE', "%{$this->search}%");
            });
        endif;
        if($this->statusFilter):
            $products = $products->where('status', $this->statusFilter);
        endif;
        if($this->stockFilter):
            $products = $products->where('quantity', '<=', Product::STOCK_LOW);
        endif;
        if($this->categoryIdFilter):
            $products = $products->whereRelation('productCategories', function($query){
                $query->whereIn('product_category_id', [$this->categoryIdFilter]);
            });
        endif;
        $products = $products->paginate($this->perPage);
        return view('livewire.admin.catalog.product.product.index', compact('products', 'categories'));
    }
    public function destroy(Product $product){
        try{
            if($product->image):
                if(Storage::exists($product->image->url)):
                    Storage::delete($product->image->url);
                endif;
                $product->image()->delete();
            endif;
            if(count($product->images)):
                foreach($product->images as $img):
                    $img->delete();
                endforeach;
            endif;
            if(count($product->comments)):
                $product->comments()->delete();
            endif;
            $product->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
    public function exportProducts(){
        $name = 'products-'.date('Y-m').'.xlsx';
        return Excel::download(new ProductExport, $name);
    }
    public function importProducts(){
        $this->validate(['excelImportTmp' => 'required']);
        try{
            Excel::import(new ProductImport, $this->excelImportTmp);
            $this->loadRandomFileTmpInputId();
            $this->reset('excelImportTmp');
            $this->emit('alert', 'success', 'Productos creados con éxito');
            $this->emit('render');
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
    public function importWordpressProducts(){
        $this->validate(['excelWordpressImportTmp' => 'required']);
        try{
            Excel::import(new ProductWordpressImport, $this->excelWordpressImportTmp);
            $this->loadRandomFileWordpressTmpInputId();
            $this->reset('excelWordpressImportTmp');
            $this->emit('alert', 'success', 'Productos creados con éxito');
            $this->emit('render');
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
    protected function loadRandomFileTmpInputId(){
        $this->fileTmpInputId = rand(1, 1000);
    }
    protected function loadRandomFileWordpressTmpInputId(){
        $this->fileWordpressTmpInputId = rand(1, 1000);
    }
}
