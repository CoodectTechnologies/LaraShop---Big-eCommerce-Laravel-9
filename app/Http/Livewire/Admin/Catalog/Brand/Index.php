<?php

namespace App\Http\Livewire\Admin\Catalog\Brand;

use App\Models\ProductBrand;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 50;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $brands = ProductBrand::query()->with('products')->orderBy('id', 'desc');
        if($this->search):
            $brands = $brands->where('name', 'LIKE', "%{$this->search}%");
        endif;
        $brands = $brands->paginate($this->perPage);
        return view('livewire.admin.catalog.brand.index', compact('brands'));
    }
    public function destroy(ProductBrand $brand){
        try{
            if($brand->image):
                if(Storage::exists($brand->image->url)):
                    Storage::delete($brand->image->url);
                endif;
                $brand->image()->delete();
            endif;
            $brand->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
