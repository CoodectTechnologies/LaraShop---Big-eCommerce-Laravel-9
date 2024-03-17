<?php

namespace App\Http\Livewire\Admin\Package\Package;

use App\Models\Package;
use App\Models\PackageFeature;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Form extends Component
{
    public $package;
    public $method;
    //Tools
    public $order;
    public $packageFeatureArray = [];

    protected function rules(){
        return [
            'package.order' => 'required',
            'package.title.'.translatable() => 'required',
            'package.subtitle.'.translatable() => 'nullable',
            'package.price' => 'nullable',
        ];
    }
    public function mount(Package $package, $method){
        $this->package = $package;
        $this->method = $method;
        $this->order = $package->order;
        $this->packageFeatureArray = $this->package->packageFeatures()->pluck('package_feature_id')->toArray();
    }
    public function render(){
        $this->loadLastOrder();
        $packageFeatures = PackageFeature::orderBy('id', 'desc')->get();
        return view('livewire.admin.package.package.form', compact('packageFeatures'));
    }
    public function hydrate(){
        $this->emit('renderJs');
    }
    public function store(){
        $this->validate();
        $this->reOrder();
        $this->package->save();
        $this->savePackageFeatures();
        $this->package = new Package();
        $this->reset('packageFeatureArray');
        Cache::forget('packages');
        $this->emit('alert', 'success', 'Paquete agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->reOrder();
        $this->package->update();
        $this->savePackageFeatures();
        Cache::forget('packages');
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    public function savePackageFeatures(){
        $this->package->packageFeatures()->sync($this->packageFeatureArray);
    }
    private function reOrder(){
        if($this->order != $this->package->order):
            $packagesToOrder = Package::where('order', '>=', $this->package->order)->get();
            foreach($packagesToOrder as $packageToOrder):
                $packageToOrder->order = $packageToOrder->order + 1;
                $packageToOrder->update();
            endforeach;
        endif;
    }
    private function loadLastOrder(){
        if(!$this->package->order):
            $lastOrder = Package::latest('order')->first();
            if($lastOrder):
                $this->package->order = ($lastOrder->order + 1);
            else:
                $this->package->order = 1;
            endif;
        endif;
    }
}
