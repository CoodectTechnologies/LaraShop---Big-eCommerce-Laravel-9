<?php

namespace Database\Seeders;

use App\Models\ConfiguratorBudgetProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguratorBudgetProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=6; $i++):
            // for($j = 0; $j<=2; $j++):
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 1,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 4,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 7,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 10,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 13,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 16,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 19,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 22,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 25,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 28,
                ]);
                ConfiguratorBudgetProduct::create([
                    'configurator_budget_id' => $i,
                    'configurator_stage_product_id' => 31,
                ]);
            // endfor;
        endfor;
    }
}
