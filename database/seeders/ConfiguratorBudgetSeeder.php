<?php

namespace Database\Seeders;

use App\Models\ConfiguratorBudget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguratorBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budget = ConfiguratorBudget::create([
            'configurator_chipset_id' => 1,
            'amount' => 21540
        ]);
        $budget = $budget->configuratorPerformances()->sync([1,2,3]);

        $budget = ConfiguratorBudget::create([
            'configurator_chipset_id' => 2,
            'amount' => 21540
        ]);
        $budget = $budget->configuratorPerformances()->sync([1,2,3]);

        $budget = ConfiguratorBudget::create([
            'configurator_chipset_id' => 1,
            'amount' => 21050
        ]);
        $budget = $budget->configuratorPerformances()->sync([1, 2]);

        $budget = ConfiguratorBudget::create([
            'configurator_chipset_id' => 2,
            'amount' => 21050
        ]);
        $budget = $budget->configuratorPerformances()->sync([1, 2]);

        $budget = ConfiguratorBudget::create([
            'configurator_chipset_id' => 1,
            'amount' => 15067
        ]);
        $budget->configuratorPerformances()->sync([1]);

        $budget = ConfiguratorBudget::create([
            'configurator_chipset_id' => 2,
            'amount' => 15067
        ]);
        $budget->configuratorPerformances()->sync([1]);
    }
}
