<?php

namespace App\Http\Livewire\Admin\Catalog\Gender;

use App\Models\ProductGender;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $gender;
    public $method;

    protected function rules(){
        return [
            'gender.name.'.translatable() => 'required',
        ];
    }
    public function mount(ProductGender $gender, $method){
        $this->gender = $gender;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.catalog.gender.form');
    }
    public function store(){
        $this->validate();
        $this->gender->save();
        $this->gender = new ProductGender();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->gender->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
