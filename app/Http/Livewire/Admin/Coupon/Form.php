<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Form extends Component
{
    public $coupon;
    public $method;
    public $currenciesArray = [];
    public $search;
    protected $queryString = ['search' => ['except' => '']];

    protected function rules(){
        return [
            'coupon.code' => 'required|unique:coupons,code,'.$this->coupon->id,
            'coupon.percentage' => 'required|min:1|max:99',
            'coupon.date_end' => 'required|date',
            'coupon.minimum_expense' => 'nullable|integer',
            'coupon.exclude_promotion' => 'nullable',
            'coupon.limit_of_use' => 'nullable',
            'coupon.active' => 'required',
        ];
    }
    public function mount(Coupon $coupon, $method){
        $this->coupon = $coupon;
        $this->method = $method;
        $this->currenciesArray = $this->coupon->currencies()->validate()->pluck('currency_id')->toArray();
    }
    public function render(){
        $currencies = Currency::validate()->get();
        return view('livewire.admin.coupon.form', compact('currencies'));
    }
    public function store(){
        $this->validate();
        $this->validateNull();
        $this->coupon->save();
        $this->saveCurrencies();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        return Redirect::route('admin.coupon.index');
    }
    public function update(){
        $this->validate();
        $this->validateNull();
        $this->coupon->update();
        $this->saveCurrencies();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
        return Redirect::route('admin.coupon.index');
    }
    private function saveCurrencies(){
        $this->coupon->currencies()->sync($this->currenciesArray);
    }
    private function validateNull(){
        if(!$this->coupon->minimum_expense):
            $this->coupon->minimum_expense = null;
        endif;
        if(!$this->coupon->limit_of_use):
            $this->coupon->limit_of_use = null;
        endif;
    }
}
