<?php

namespace Database\Seeders;

use App\Models\ConfiguratorGame;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguratorGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $performances = [
            [
                'name' =>  'Forntie',
                'image' =>  'https://nzxt.com/assets/cms/34299/1620400487-fortnite-1.png?auto=format&fit=clamp&h=127&w=127',
            ],
            [
                'name' =>  'Modern Warframe 3',
                'image' =>  'https://nzxt.com/assets/cms/34299/1620400903-modern-warfare-alt.png?auto=format&fit=clamp&h=127&w=127',
            ],
            [
                'name' =>  'Minecraft',
                'image' =>  'https://nzxt.com/assets/cms/34299/1620400899-minecraft-logo.png?auto=format&fit=clamp&h=127&w=127',
            ],
            [
                'name' =>  'Grand Theft Auto V',
                'image' =>  'https://nzxt.com/assets/cms/34299/1620400892-gta.png?auto=format&fit=clamp&h=127&w=127',
            ]
        ];
        foreach($performances as $performance):
            $game = ConfiguratorGame::create([
                'name' => $performance['name']
            ]);
            $game->image()->create(['url' => $performance['image']]);
        endforeach;
    }
}
