<?php

namespace App\Http\Livewire\Admin\Setting\Country;

use App\Models\Country;
use Livewire\Component;

class Form extends Component
{
    public $country;
    public $method;

    public function mount(Country $country, $method){
        $this->country = $country;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'country.code' => 'required|unique:countries,code,'.$this->country->id,
            'country.name' => 'required|unique:countries,name,'.$this->country->id,
            'country.status' => 'required',
            'country.phonecode' => 'nullable',
            'country.default' => 'nullable',
        ];
    }
    public function render(){
        return view('livewire.admin.setting.country.form');
    }
    public function store(){
        $this->validate();
        if(!$this->validateDefault()): return false; endif;
        $this->country->save();
        $this->saveDefault();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        $this->country = new Country();
    }
    public function update(){
        $this->validate();
        if(!$this->validateDefault()): return false; endif;
        $this->country->update();
        $this->saveDefault();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
    public function validateDefault(){
        $validateDefault = true;
        if($this->country->exists):
            $countryDefault = Country::where('default', true)->where('id', $this->country->id)->first();
            if(
                $countryDefault &&
                $countryDefault->default &&
                !$this->country->default
            ):
                $this->emit('alert', 'warning', __('You cannot remove the default of this country, you must default to another country'));
                $validateDefault = false;
            endif;
        endif;
        return $validateDefault;
    }
    public function saveDefault(){
        if(!Country::count()):
            $this->country->default = true;
            $this->country->active = true;
        else:
            if($this->country->default):
                Country::query()->where('id', '<>', $this->country->id)->update([
                    'default' => false
                ]);
            endif;
        endif;
    }
}
