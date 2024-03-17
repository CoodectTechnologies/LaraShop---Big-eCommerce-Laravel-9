<?php

namespace App\Http\Livewire\Admin\Catalog\Product\Product;

use App\Models\Currency;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductGender;
use App\Models\ShippingClass;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    protected $listeners = ['render'];

    public $product;
    public $method;
    public $imageTmp, $imagesTmp = [], $imagesTmpInputId;
    public $catalogCategoryArray = [];
    public $catalogGenderArray = [];
    public $technicalDatasheetTmp;
    public $fileDigitalTmp;

    public function rules(){
        return [
            'product.product_brand_id' => 'nullable',
            'product.shipping_class_id' => 'nullable',
            'product.name.'.translatable() => 'required',
            'product.price' => 'required',
            'product.detail.'.translatable() => 'nullable',
            'product.description.'.translatable() => 'nullable',
            'product.search_advanced.'.translatable() => 'nullable',
            'product.sku' => 'nullable',
            'product.quantity' => 'nullable|numeric',
            'product.featured' => 'nullable',
            'product.status' => 'required',
            'product.iframe_url' => 'nullable',
            'product.type' => 'required',
            'product.downloadable' => 'nullable',
            'product.link_amazon' => 'nullable',
            'product.link_mercadolibre' => 'nullable',
            'product.weight_kl' => 'nullable',
            'product.weight_gr' => 'nullable',
            'product.height' => 'nullable',
            'product.width' => 'nullable',
            'product.length' => 'nullable',
            'product.meta_title.'.translatable() => 'nullable',
            'product.meta_description.'.translatable() => 'nullable',
            'product.meta_keywords.'.translatable() => 'nullable',
            'technicalDatasheetTmp' => 'nullable',
            'fileDigitalTmp' => ($this->product->getIsDigital() && !$this->product->file_digital) ? 'required' : 'nullable',
        ];
    }
    public function mount(Product $product, $method, Request $request){
        $this->product = $product;
        $this->method = $method;
        $this->catalogCategoryArray = $this->product->productCategories()->pluck('product_category_id')->toArray();
        $this->catalogGenderArray = $this->product->productGenders()->pluck('product_gender_id')->toArray();
        $this->product->status = $this->product->id ? $this->product->status : 'Publicado';
        $this->product->type = $this->product->id ? $this->product->type : Product::TYPE_PHYSICAL;
        $this->loadRandomImagesTmpInputId();
    }
    public function render(){
        $currencies = Currency::validate()->get();
        $categories = ProductCategory::with(['allChildrens' => function($query){
            $query->orderBy('name', 'asc');
        }])->whereNull('parent_id')->orderBy('name', 'asc')->get();
        $brands = ProductBrand::orderBy('id', 'desc')->get();
        $genders = ProductGender::orderBy('id', 'desc')->get();
        $shippingClasses = ShippingClass::orderBy('id', 'desc')->get();
        $productImages = $this->product->images()->orderBy('id', 'desc')->get();
        return view('livewire.admin.catalog.product.product.form', compact('currencies', 'categories', 'brands', 'genders', 'shippingClasses', 'productImages'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->validateNull();
        $this->product->user_id = Auth::id();
        $this->_saveTechnicalDatasheet();
        $this->_saveFileDigital();
        $this->product->save();
        $this->save();
        Session::flash('alert', __('Registration successfully added'));
        Session::flash('alert-type', 'success');
        Redirect::route('admin.catalog.product.show', $this->product);
    }
    public function update(){
        $this->validate();
        $this->validateNull();
        $this->_saveTechnicalDatasheet();
        $this->_saveFileDigital();
        $this->product->update();
        $this->save();
        Session::flash('alert', __('Registration successfully added'));
        Session::flash('alert-type', 'success');
        Redirect::route('admin.catalog.product.show', $this->product);
    }
    private function save(){
        $this->saveImage();
        $this->saveImages();
        $this->saveCategories();
        $this->saveGenders();
        $this->loadRandomImagesTmpInputId();
        $this->reset('imagesTmp');
    }
    private function saveImage(){
        if($this->imageTmp):
            $url = $this->imageTmp->store('public/catalog/product');
            imageManager($url, 800, $this->product);
        endif;
    }
    private function saveImages(){
        if($this->imagesTmp):
            foreach ($this->imagesTmp as $imgTmp):
                $url = $imgTmp->store('public/catalog/product/gallery');
                imagesManager($url, 800, $this->product);
            endforeach;
        endif;
    }
    private function saveCategories(){
        $this->product->productCategories()->sync($this->catalogCategoryArray);
    }
    private function saveGenders(){
        $this->product->productGenders()->sync($this->catalogGenderArray);
    }
    private function _saveTechnicalDatasheet(){
        if($this->technicalDatasheetTmp):
            $url = $this->technicalDatasheetTmp->store('public/product/technical-datasheet');
            if($this->product->technical_datasheet):
                if(Storage::exists($this->product->technical_datasheet)):
                    Storage::delete($this->product->technical_datasheet);
                endif;
            endif;
            $this->product->technical_datasheet = $url;
        endif;
    }
    private function _saveFileDigital(){
        if($this->fileDigitalTmp):
            $url = $this->fileDigitalTmp->store('public/product/file-digital');
            if($this->product->file_digital):
                if(Storage::exists($this->product->file_digital)):
                    Storage::delete($this->product->file_digital);
                endif;
            endif;
            $this->product->file_digital = $url;
        endif;
    }
    public function removeImageTemp($key){
        if(array_splice($this->imagesTmp, $key, 1)):
            $this->emit('alert', 'success', __('Image successfully deleted'));
        endif;
    }
    public function removeImageMain(){
        if($this->product->image):
            if(Storage::exists($this->product->image->url)):
                Storage::delete($this->product->image->url);
            endif;
            $this->product->image()->delete();
            $this->product->image = null;
        endif;
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
    public function removeImage(Image $image){
        try{
            $image->delete();
            $this->emit('alert', 'success', __('Image successfully deleted'));
        }catch(Exception $e){
            $this->emit('alert', 'warning', $e->getMessage());
        }
    }
    public function removeTechnicalDatasheet(){
        if($this->product->technical_datasheet):
            if(Storage::exists($this->product->technical_datasheet)):
                Storage::delete($this->product->technical_datasheet);
            endif;
            $this->product->technical_datasheet = null;
            $this->product->update();
        endif;
        $this->reset('technicalDatasheetTmp');
        $this->emit('alert', 'success', __('Successful elimination'));
    }
    public function removeFileDigital(){
        if($this->product->file_digital):
            if(Storage::exists($this->product->file_digital)):
                Storage::delete($this->product->file_digital);
            endif;
            $this->product->file_digital = null;
            $this->product->update();
        endif;
        $this->reset('fileDigitalTmp');
        $this->emit('alert', 'success', __('Successful elimination'));
    }
    private function loadRandomImagesTmpInputId(){
        $this->imagesTmpInputId = rand(1, 1000).'-'.$this->product->id;
    }
    private function validateNull(){
        if($this->product->quantity == ''):
            $this->product->quantity = null;
        endif;
        if($this->product->weight_kl == ''):
            $this->product->weight_kl = null;
        endif;
        if($this->product->weight_gr == ''):
            $this->product->weight_gr = null;
        endif;
        if($this->product->height == ''):
            $this->product->height = null;
        endif;
        if($this->product->width == ''):
            $this->product->width = null;
        endif;
        if($this->product->length == ''):
            $this->product->length = null;
        endif;
        if($this->product->product_brand_id == ''):
            $this->product->product_brand_id = null;
        endif;
        if($this->product->shipping_class_id == ''):
            $this->product->shipping_class_id = null;
        endif;
        if($this->product->downloadable == ''):
            $this->product->downloadable = null;
        endif;
        if(
            isset($this->catalogCategoryArray[0]) &&
            $this->catalogCategoryArray[0] == __('Without categories')
        ):
            $this->catalogCategoryArray = [];
        endif;
        if(
            isset($this->catalogGenderArray[0]) &&
            $this->catalogGenderArray[0] == __('Without gender')
        ):
            $this->catalogGenderArray = [];
        endif;
    }
}
