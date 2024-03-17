<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Sitios web', 'Marketing digital', 'SEO', 'Diseño gráfico'];
        foreach($categories as $category){
            BlogCategory::create([
                'name' => [config('translatable.fallback') => $category]
            ]);
        }
    }
}
