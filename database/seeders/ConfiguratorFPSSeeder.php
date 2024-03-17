<?php

namespace Database\Seeders;

use App\Models\ConfiguratorBudget;
use App\Models\ConfiguratorChipset;
use App\Models\ConfiguratorFPS;
use App\Models\ConfiguratorGame;
use App\Models\ConfiguratorPerformance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguratorFPSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $games = ConfiguratorGame::orderByDesc('id')->cursor();
        $performances = ConfiguratorPerformance::orderByDesc('id')->cursor();
        $budgets = ConfiguratorBudget::orderBy('amount')->cursor();
        $chipsets = ConfiguratorChipset::orderBy('id')->cursor();
        foreach($games as $game):
            foreach($performances as $performance):
                foreach($budgets as $budget):
                    foreach($chipsets as $chipset):
                        ConfiguratorFPS::create([
                            'configurator_game_id' => $game->id,
                            'configurator_performance_id' => $performance->id,
                            'configurator_budget_id' => $budget->id,
                            'configurator_chipset_id' => $chipset->id,
                            'fps' => rand(30, 200)
                        ]);
                    endforeach;
                endforeach;
            endforeach;
        endforeach;
    }
}
