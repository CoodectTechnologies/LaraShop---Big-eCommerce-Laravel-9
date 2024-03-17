<?php

namespace Database\Seeders;

use App\Models\ConfiguratorChipset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguratorChipsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chipsets = ['AMD', 'Intel'];
        foreach($chipsets as $chipset):
            ConfiguratorChipset::create([
                'name' => $chipset
            ]);
        endforeach;
    }
}
