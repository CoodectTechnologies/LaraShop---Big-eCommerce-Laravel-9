<?php

namespace App\Http\Livewire\Admin\Configurator\Fps;

use App\Models\ConfiguratorBudget;
use App\Models\ConfiguratorChipset;
use App\Models\ConfiguratorFPS;
use App\Models\ConfiguratorGame;
use App\Models\ConfiguratorPerformance;
use Livewire\Component;

class Form extends Component
{
    public $fps = [];
    public $fpsArray = [];
    public $method;

    public function mount($method){
        $this->method = $method;
        $this->loadFPS();
    }
    public function render(){
        return view('livewire.admin.configurator.fps.form');
    }
    public function save(){
        foreach($this->fps['games'] as $gameId => $game):
            foreach($game['performances'] as $performanceId => $performance):
                foreach($performance['budgets'] as $budgetId => $budget):
                    foreach($budget['chipsets'] as $chipsetId => $chipset):
                        $fps = $chipset['fps'];
                        $configuratorFPS = ConfiguratorFPS::where('configurator_game_id', $gameId)
                        ->where('configurator_performance_id', $performanceId)
                        ->where('configurator_budget_id', $budgetId)
                        ->where('configurator_chipset_id', $chipsetId)
                        ->first();
                        if($configuratorFPS):
                            if($configuratorFPS->fps != $fps):
                                $configuratorFPS->fps = $fps;
                                $configuratorFPS->update();
                            endif;
                        else:
                            if($fps):
                                ConfiguratorFPS::create([
                                    'configurator_game_id' => $gameId,
                                    'configurator_performance_id' => $performanceId,
                                    'configurator_budget_id' => $budgetId,
                                    'configurator_chipset_id' => $chipsetId,
                                    'fps' => $fps
                                ]);
                            endif;
                        endif;
                    endforeach;
                endforeach;
            endforeach;
        endforeach;
        $this->emit('alert', 'success', __('Changes saves'));
        $this->emit('render');
    }
    public function loadFPS(){
        $games = ConfiguratorGame::orderByDesc('id')->get();
        $performances = ConfiguratorPerformance::orderByDesc('id')->get();
        $budgets = ConfiguratorBudget::orderBy('amount')->get();
        $chipsets = ConfiguratorChipset::orderBy('id')->get();
        foreach($games as $game):
            $this->fpsArray['games'][$game->id] = $game->toArray();
            $this->fpsArray['games'][$game->id]['imagePreview'] = $game->imagePreview();
            foreach($performances as $performance):
                $this->fpsArray['games'][$game->id]['performances'][$performance->id] = $performance->toArray();
                foreach($budgets as $budget):
                    $this->fpsArray['games'][$game->id]['performances'][$performance->id]['budgets'][$budget->id] = $budget->toArray();
                    $this->fpsArray['games'][$game->id]['performances'][$performance->id]['budgets'][$budget->id]['amount'] = $budget->amountToString();
                    foreach($chipsets as $chipset):
                        $configuratorFPS = ConfiguratorFPS::query()
                        ->where('configurator_game_id', $game->id)
                        ->where('configurator_performance_id', $performance->id)
                        ->where('configurator_budget_id', $budget->id)
                        ->where('configurator_chipset_id', $chipset->id)
                        ->first();
                        $fps = $configuratorFPS ? $configuratorFPS->fps : null;
                        $this->fps['games'][$game->id]['performances'][$performance->id]['budgets'][$budget->id]['chipsets'][$chipset->id]['fps'] = $fps;
                        $this->fpsArray['games'][$game->id]['performances'][$performance->id]['budgets'][$budget->id]['chipsets'][$chipset->id] = $chipset->toArray();
                    endforeach;
                endforeach;
            endforeach;
        endforeach;
    }
}
