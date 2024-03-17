<?php

namespace App\Http\Livewire\Admin\Setting\ShippingClass;

use App\Models\ShippingClass;
use Livewire\Component;

class Form extends Component
{
    public $shippingClass;
    public $method;

    public function mount(ShippingClass $shippingClass, $method){
        $this->shippingClass = $shippingClass;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'shippingClass.name' => 'required|unique:shipping_classes,name,'.$this->shippingClass->id,
            'shippingClass.description' => 'nullable',
        ];
    }
    public function render(){
        return view('livewire.admin.setting.shipping-class.form');
    }
    public function store(){
        $this->validate();
        $this->shippingClass->save();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
        $this->shippingClass = new ShippingClass();
    }
    public function update(){
        $this->validate();
        $this->shippingClass->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
