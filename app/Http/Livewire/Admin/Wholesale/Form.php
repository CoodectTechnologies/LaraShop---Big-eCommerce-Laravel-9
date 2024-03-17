<?php

namespace App\Http\Livewire\Admin\Wholesale;

use App\Models\Currency;
use App\Models\Product;
use App\Models\Wholesale;
use App\Models\WholesaleDetail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Form extends Component
{
    public $wholesale;
    public $method;
    //Tools
    public $currenciesArray = [];
    public $productsArray = [];
    //Inputs dinamics
    public $wholesaleDetails;
    public $wholesaleDetailsTMP;
    //Querys search
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    protected function rules(){
        return [
            'wholesale.name' => 'required',
            'wholesale.type' => 'required',
            'wholesaleDetails' => 'nullable',
            'wholesaleDetailsTMP' => !count($this->wholesale->wholesaleDetails) ? 'required|array|min:1' : 'nullable',
            'wholesaleDetailsTMP.*.qty_from' => count($this->wholesaleDetailsTMP) ? 'required|numeric' : 'nullable',
            'wholesaleDetailsTMP.*.qty_to' => count($this->wholesaleDetailsTMP) ? 'required|numeric' : 'nullable',
            'wholesaleDetailsTMP.*.percentage' => count($this->wholesaleDetailsTMP) ? 'required|numeric' : 'nullable',
            'productsArray' => $this->wholesale->type != 'Todos' ? 'required|array|min:1' : 'nullable',
        ];
    }
    public function mount(Wholesale $wholesale, $method){
        $this->wholesale = $wholesale;
        $this->method = $method;
        $this->currenciesArray = $this->wholesale->currencies()->pluck('currency_id')->toArray();
        $this->productsArray = $this->wholesale->products()->pluck('product_id')->toArray();
        $this->wholesaleDetails = new Collection();
        $this->wholesaleDetailsTMP = new Collection();
        $this->_loadWholesaleDetails();
    }
    public function render(){
        $currencies = Currency::validate()->get();
        $products = $this->_getProducts();
        return view('livewire.admin.wholesale.form', compact('currencies', 'products'));
    }
    public function store(){
        $this->validate();
        $this->wholesale->save();
        $this->saveCurrencies();
        $this->saveWholesaleDetails();
        $this->saveProducts();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.wholesale.index');
    }
    public function update(){
        $this->validate();
        $this->wholesale->update();
        $this->saveCurrencies();
        $this->saveWholesaleDetails();
        $this->saveProducts();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        Redirect::route('admin.wholesale.index');
    }
    /*===== _saves =====*/
    private function saveCurrencies(){
        $this->wholesale->currencies()->sync($this->currenciesArray);
    }
    private function saveWholesaleDetails(){
        foreach($this->wholesaleDetailsTMP as $wholesaleDetailInput):
            $this->wholesale->wholesaleDetails()->create($wholesaleDetailInput);
        endforeach;
        foreach($this->wholesaleDetails as $wholesaleDetail):
            $oWholesaleDetail = WholesaleDetail::find($wholesaleDetail['id']);
            $oWholesaleDetail->qty_from = $wholesaleDetail['qty_from'];
            $oWholesaleDetail->qty_to = $wholesaleDetail['qty_to'];
            $oWholesaleDetail->percentage = $wholesaleDetail['percentage'];
            $oWholesaleDetail->update();
        endforeach;
    }
    private function saveProducts(){
        $this->wholesale->products()->sync($this->productsArray);
    }
    public function changeType(){
        $this->productsArray = [];
    }
    /*===== Inputs dinamics =====*/
    public function addWholesaleDetailTMP(){
        $this->wholesaleDetailsTMP->push([
            'qty_from' => '',
            'qty_to' => '',
            'percentage' => ''
        ]);
    }
    public function removeWholesaleDetailTMP($key){
        $this->wholesaleDetailsTMP->pull($key);
    }
    public function removeWholesaleDetail(WholesaleDetail $wholesaleDetail, $key){
        $wholesaleDetail->delete();
        $this->wholesaleDetails->pull($key);
    }
    /*===== GETS AND FILTERS =====*/
    private function _getProducts(){
        $products = Product::orderBy('name');
        $products = $this->_applyFilter($products);
        $products = $products->get();
        return $products;
    }
    private function _applyFilter($products){
        if($this->search):
            $products = $products->where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('sku', 'LIKE', "%{$this->search}%");
        endif;
        return $products;
    }
    /*===== LOADS =====*/
    private function _loadWholesaleDetails(){
        foreach($this->wholesale->wholesaleDetails()->get() as $wholeSaleDetail):
            $this->wholesaleDetails->push([
                'id' => $wholeSaleDetail->id,
                'qty_from' => $wholeSaleDetail->qty_from,
                'qty_to' => $wholeSaleDetail->qty_to,
                'percentage' => $wholeSaleDetail->percentage,
            ]);
        endforeach;
    }
}
