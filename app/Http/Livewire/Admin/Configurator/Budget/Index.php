<?php

namespace App\Http\Livewire\Admin\Configurator\Budget;

use App\Models\ConfiguratorBudget;
use Exception;
use Livewire\Component;

class Index extends Component
{
    public function render(){
        $configuratorBudgets = ConfiguratorBudget::with('configuratorChipset')->orderByDesc('id')->get();
        return view('livewire.admin.configurator.budget.index', compact('configuratorBudgets'));
    }
    public function destroy(ConfiguratorBudget $configuratorBudget){
        try{
            $configuratorBudget->products()->detach();
            $configuratorBudget->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
