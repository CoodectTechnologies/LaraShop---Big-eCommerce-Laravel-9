<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tips = ['Tips', 'Beneficios'];
        foreach($tips as $tip){
            BlogTag::create([
                'name' => [config('translatable.fallback') => $tip]
            ]);
        }
    }
}
