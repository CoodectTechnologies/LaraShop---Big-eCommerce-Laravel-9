<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Color;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public $product;

    public function mount(Product $product){
        $this->product = $product;
    }
    public function render(){
        $colors = $this->product->productColors()->get();
        return view('livewire.admin.catalog.product.color.index', compact('colors'));
    }
    public function destroy(ProductColor $color){
        try{
            if(count($color->images)):
                foreach($color->images as $img):
                    if(Storage::exists($img->url)):
                        Storage::delete($img->url);
                    endif;
                endforeach;
                $color->images()->delete();
            endif;
            $color->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
