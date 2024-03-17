<?php

namespace App\Http\Livewire\Admin\Configurator\Performance;

use App\Models\ConfiguratorPerformance;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $configuratorPerformances = ConfiguratorPerformance::orderByDesc('id')->get();
        return view('livewire.admin.configurator.performance.index', compact('configuratorPerformances'));
    }
    public function destroy(ConfiguratorPerformance $banner){
        try{
            $banner->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
