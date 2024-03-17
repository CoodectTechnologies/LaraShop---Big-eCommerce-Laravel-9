<?php

namespace Database\Seeders;

use App\Models\ProductGender;
use Illuminate\Database\Seeder;

class ProductGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = ['Mujeres', 'Jovenes', 'Niñas'];
        foreach($genders as $gender){
            ProductGender::create([
                'name' => [config('translatable.fallback') => $gender]
            ]);
        }
    }
}
