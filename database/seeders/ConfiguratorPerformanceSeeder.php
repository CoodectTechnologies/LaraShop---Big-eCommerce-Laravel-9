<?php

namespace Database\Seeders;

use App\Models\ConfiguratorPerformance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguratorPerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performances = ['1080', '1440', '4K'];
        foreach($performances as $performance):
            ConfiguratorPerformance::create([
                'name' => $performance
            ]);
        endforeach;
    }
}
