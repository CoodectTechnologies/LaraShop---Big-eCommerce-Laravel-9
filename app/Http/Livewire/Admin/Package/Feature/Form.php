<?php

namespace App\Http\Livewire\Admin\Package\Feature;

use App\Models\PackageFeature;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{
    public $packageFeature;
    public $method;

    protected function rules(){
        return [
            'packageFeature.name.'.translatable() => 'required',
        ];
    }
    public function mount(PackageFeature $packageFeature, $method){
        $this->packageFeature = $packageFeature;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.package.feature.form');
    }
    public function store(){
        $this->validate();
        $this->packageFeature->save();
        $this->packageFeature = new PackageFeature();
        Cache::forget('packageFeatures');
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->packageFeature->update();
        Cache::forget('packageFeatures');
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
}
