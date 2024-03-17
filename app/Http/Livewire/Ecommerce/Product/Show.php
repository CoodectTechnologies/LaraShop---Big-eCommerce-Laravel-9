<?php

namespace App\Http\Livewire\Ecommerce\Product;

use App\Http\Controllers\Ecommerce\Cart\CartController;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $gallery;
    public $colors;
    public $sizes;
    public $price;
    public $quantity;
    public $type;

    public $colorSelected;
    public $sizeSelected;
    public $priceToString;
    public $quantitySelected = 1;

    public $productsViewRecents;

    protected function rules(){
        return [
            'quantitySelected' => 'required',
        ];
    }
    public function mount(Product $product, $productsViewRecents){
        $this->product = $product;
        $this->productsViewRecents = $productsViewRecents;
        $this->product->load(['images', 'productCategories', 'productSizes', 'productColors', 'productSimilars']);
        $this->loadGallery();
        $this->loadColor();
        $this->loadSize();
        $this->loadType();
    }
    public function render(){
        $commentCount = $this->product->comments()->validate()->count();
        $productsRelated = $this->productsRelated();
        return view('livewire.ecommerce.product.show', compact('commentCount', 'productsRelated'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function loadColor($colorId = null){
        if(!$colorId):
            $this->colors = $this->product->productColors;
        else:
            $this->colorSelected = ProductColor::with('productSizes')->findOrFail($colorId);
            $this->loadPrice();
            $this->loadQuantity();
            $this->loadGallery($this->colorSelected);
        endif;
    }
    public function loadSize($sizeId = null){
        if(!$sizeId):
            $this->sizes = $this->product->productSizes;
            $this->reset('sizeSelected');
            $this->loadPrice();
            $this->loadQuantity();
        else:
            $this->sizeSelected = ProductSize::with('productColors')->findOrFail($sizeId);
            if($this->colorSelected):
                if(!$this->sizeSelected->validateSizeColorSelected($this->colorSelected->id)):
                    $this->reset('colorSelected');
                endif;
            endif;
            $this->loadPrice();
            $this->loadQuantity();
        endif;
    }
    public function loadType(){
        $this->type = $this->product->getType();
        if($this->type == Product::TYPE_PHYSICAL_AND_DIGITAL):
            $this->type = Product::TYPE_PHYSICAL;
        endif;
    }
    public function loadQuantity(){
        if($this->type == Product::TYPE_DIGITAL):
            $this->quantity = $this->product->quantity;
            return;
        endif;
        if(
            !$this->sizeSelected &&
            !$this->colorSelected
        ):
            $this->quantity = $this->product->quantity;
        endif;
        if($this->colorSelected):
            $this->quantity = $this->colorSelected->quantity;
        endif;
        if($this->sizeSelected):
            $this->quantity = $this->sizeSelected->quantity;
        endif;
        if(
            $this->sizeSelected &&
            $this->colorSelected
        ):
            if($this->sizeSelected->relation_with_colors != 'SI'):
                $this->quantity = $this->sizeSelected->quantity;
            else:
                $sizeColor = $this->sizeSelected->productColors->where('id', $this->colorSelected->id)->first();
                if($sizeColor):
                    $this->quantity = $sizeColor->pivot->quantity;
                endif;
            endif;
        endif;
    }
    public function loadPrice(){
        if($this->sizeSelected && $this->type == Product::TYPE_PHYSICAL):
            //Obtenemos el precio de la medida del producto
            $this->priceToString = $this->sizeSelected->getPriceToString();
            $this->price = $this->sizeSelected->getPriceFinal();

        elseif($this->type == Product::TYPE_DIGITAL):
            //Si es tipo digital, entonces tomamos el precio del producto general
            $price = $this->product->getPriceFinal();
            $this->priceToString = '$'.number_format($price, 2).' '.Session::get('currency');
            $this->price = $price;

        else:
            //Si no existen variaciones, o alguna medida seleccionada, Obtenemos el precio y la cantidad del producto general
            $this->priceToString = $this->product->getPriceToString();
            $this->price = $this->product->getPriceFinal();
        endif;
    }
    public function loadGallery($color = null){
        if($color):
            $this->gallery = $color->images()->get();
        else:
            $imageMain = $this->product->image()->get();
            $gallery = $this->product->images()->get();
            $this->gallery = $imageMain->merge($gallery);
        endif;
    }
    public function updatedType($type){
        $this->loadPrice();
        $this->loadQuantity();
        $this->reset('quantitySelected');
    }
    public function addCart(){
        if($this->type == Product::TYPE_DIGITAL):
            $this->quantitySelected = 1;
            $this->resetVariation();
        endif;
        $options = [
            'size' => [
                'id' => $this->sizeSelected ? $this->sizeSelected->id : null,
                'name' => $this->sizeSelected ? $this->sizeSelected->name : null,
            ],
            'color' => [
                'id' => $this->colorSelected ? $this->colorSelected->id : null,
                'name' => $this->colorSelected ? $this->colorSelected->name : null,
            ],
            'image' => isset($this->gallery[0]) ? $this->gallery[0]->imagePreview() : $this->product->imagePreview(),
            'price' => $this->price,
            'type' => $this->type
        ];
        $addCart = CartController::store($this->product, $this->quantitySelected, $this->price, $options);
        if($addCart === true):
            $this->emitTo('ecommerce.layouts.cart', 'render');
            $this->emit(
                'notifyAddCart',
                $this->product->name,
                route('ecommerce.product.show', $this->product),
                isset($this->gallery[0]) ? $this->gallery[0]->imagePreview() : $this->product->imagePreview()
            );
            $this->reset('quantitySelected');
        endif;
    }
    public function getTypes(){
        $types = [];
        if($this->product->getIsPhysical()):
            $types[Product::TYPE_PHYSICAL] = Product::TYPE_PHYSICAL;
        endif;
        if($this->product->getIsDigital()):
            $types[Product::TYPE_DIGITAL] = Product::TYPE_DIGITAL;
        endif;
        return $types;
    }
    public function resetVariation(){
        $this->reset('sizeSelected', 'colorSelected');
    }
    private function productsRelated(){
        $productsRelated = [];
        if(count($this->product->productSimilars)):
            $ids = $this->product->productSimilars()->pluck('product_similar_id');
            $productsRelated = Product::validateProduct()->whereIn('id', $ids)->where('id', '<>', $this->product->id)->get();
        else:
            if($category = $this->product->productCategories()->first()):
                $productsRelated = Product::query()->inRandomOrder()->validateProduct()->whereHas('productCategories', function($query) use($category) {
                    $query->whereIn('product_category_id', [$category->id]);
                })->where('id', '<>', $this->product->id)->take(5)->get();
            endif;
        endif;
        return $productsRelated;
    }
}
