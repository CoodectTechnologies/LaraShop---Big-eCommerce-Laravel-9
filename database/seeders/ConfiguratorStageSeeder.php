<?php

namespace Database\Seeders;

use App\Models\ConfiguratorStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguratorStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'PROCESADOR'],
            'order' => 1,
            'optional' => false,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([1, 2, 3]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'DISIPADOR DE CALOR'],
            'order' => 2,
            'optional' => false,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([4, 5, 6]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'TARJETA MADRE'],
            'order' => 3,
            'optional' => false,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([7, 8, 9]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'MEMORIA RAM'],
            'order' => 4,
            'optional' => false,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([10, 11, 12]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'MEMORIA RAM ADICIONAL'],
            'order' => 5,
            'optional' => true,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([10, 11, 12]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'ALMACENAMIENTO'],
            'order' => 6,
            'optional' => false,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([13, 14, 15]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'ALMACENAMIENTO ADICIONAL'],
            'order' => 7,
            'optional' => true,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([13, 14, 15]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'TARJETA GRÁFICA'],
            'order' => 8,
            'optional' => true,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([16, 17, 18]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'GABINETE'],
            'order' => 9,
            'optional' => false,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([19, 20, 21]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'FUENTE DE PODER'],
            'order' => 10,
            'optional' => false,
            'type' => ConfiguratorStage::TYPE_COMPONENT
        ]);
        $stage->products()->attach([22, 23, 24]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'MONITORES'],
            'order' => 1,
            'optional' => true,
            'type' => ConfiguratorStage::TYPE_ADDON
        ]);
        $stage->products()->attach([25, 26]);

        $stage = ConfiguratorStage::create([
            'name' => [config('translatable.fallback') => 'TECLADOS'],
            'order' => 2,
            'optional' => true,
            'type' => ConfiguratorStage::TYPE_ADDON
        ]);
        $stage->products()->attach([27, 28]);
    }
}
