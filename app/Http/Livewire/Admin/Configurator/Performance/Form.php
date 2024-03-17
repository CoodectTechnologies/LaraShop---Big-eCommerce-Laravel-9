<?php

namespace App\Http\Livewire\Admin\Configurator\Performance;

use App\Models\ConfiguratorPerformance;
use Livewire\Component;

class Form extends Component
{
    public $configuratorPerformance;
    public $method;

    protected function rules(){
        return [
            'configuratorPerformance.name' => 'required'
        ];
    }
    public function mount(ConfiguratorPerformance $configuratorPerformance, $method){
        $this->configuratorPerformance = $configuratorPerformance;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.configurator.performance.form');
    }
    public function store(){
        $this->validate();
        $this->configuratorPerformance->save();
        $this->configuratorPerformance = new ConfiguratorPerformance();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->configuratorPerformance->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
