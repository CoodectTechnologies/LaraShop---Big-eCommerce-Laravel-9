<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = [
            'information' => [config('translatable.fallback') => 'Remplaza por tu propia información'],
            'mission' => [config('translatable.fallback') => 'Remplaza por tu propia información'],
            'vision' => [config('translatable.fallback') => 'Remplaza por tu propia información'],
            'values' => [config('translatable.fallback') => 'Remplaza por tu propia información'],
        ];
        About::create($about);
    }
}
