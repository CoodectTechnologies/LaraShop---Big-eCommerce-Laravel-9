<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesArray = [
            [
                'name' => 'PROCESADORES',
                'description' => '',
            ],
            [
                'name' => 'TARJETAS MADRES',
                'description' => '',
            ],
            [
                'name' => 'MEMORIAS RAM',
                'description' => '',
            ],
            [
                'name' => 'TARJETAS GRAFICAS',
                'description' => '',
            ],
            [
                'name' => 'FUENTES DE PODER',
                'description' => '',
            ],
            [
                'name' => 'DISIPADORES DE CALOR',
                'description' => '',
            ],
            [
                'name' => 'ALMACENAMIENTOS',
                'description' => '',
            ],
            [
                'name' => 'GABINETES',
                'description' => '',
            ],
            [
                'name' => 'MONITORES',
                'description' => '',
            ],
            [
                'name' => 'TECLADOS',
                'description' => '',
            ],
            [
                'name' => 'RATONES',
                'description' => '',
            ],
            [
                'name' => 'ILUMINACION RBG',
                'description' => '',
            ],
            [
                'name' => 'BOSINAS',
                'description' => '',
            ],
            [
                'name' => 'SOFTWARE',
                'description' => '',
            ],
        ];
        foreach($categoriesArray as $categoryArray){
            $category = $this->createCategory($categoryArray);
            foreach($categoryArray as $key => $value){
                if(is_array($value)):
                    $this->mapCategory($value, $category->id);
                endif;
            }
        }
    }
    private function mapCategory($categoryArray, $parentId = null){
        $category = $this->createCategory($categoryArray, $parentId);
        foreach($categoryArray as $key => $value):
            if(is_array($value)):
                $this->mapCategory($value, $category->id);
            endif;
        endforeach;
    }
    private function createCategory($categoryArray, $parentId = null){
        $category = ProductCategory::create([
            'name' => [config('translatable.fallback') => $categoryArray['name']],
            'description' => [config('translatable.fallback') => $categoryArray['description']],
            'parent_id' => $parentId
        ]);
        if(isset($categoryArray['image'])):
            $category->image()->create([
                'url' => $categoryArray['image'],
                'main' => true
            ]);
        endif;
        return $category;
    }
}
