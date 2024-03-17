<?php

namespace App\Http\Livewire\Admin\Configurator\Stage;

use App\Models\ConfiguratorStage;
use Exception;
use Livewire\Component;

class Index extends Component
{

    public $search;
    public $typeFilter;
    protected $queryString = ['search' => ['except' => '']];

    public function render(){
        $configuratorStages = ConfiguratorStage::orderBy('order');
        if($this->search):
            $configuratorStages = $configuratorStages->where('name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->typeFilter):
            $configuratorStages = $configuratorStages->where('type', $this->typeFilter);
        endif;
        $configuratorStages = $configuratorStages->get();
        return view('livewire.admin.configurator.stage.index', compact('configuratorStages'));
    }
    public function getTypes(){
        return [ConfiguratorStage::TYPE_COMPONENT, ConfiguratorStage::TYPE_ADDON];
    }
    public function destroy(ConfiguratorStage $configuratorStage){
        try{
            if(count($configuratorStage->configuratorCompatibilities)):
                foreach($configuratorStage->configuratorCompatibilities as $cC):
                    $cC->products()->detach();
                endforeach;
                $configuratorStage->configuratorCompatibilities()->delete();
            endif;
            $configuratorStage->products()->detach();
            $configuratorStage->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
