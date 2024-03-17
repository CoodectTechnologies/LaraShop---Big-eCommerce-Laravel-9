<?php

namespace App\Http\Livewire\Ecommerce\Category;

use App\Models\ProductCategory;
use Livewire\Component;

class Index extends Component
{
    public function render(){
        $categories = ProductCategory::orderBy('id', 'desc')->get();
        return view('livewire.ecommerce.category.index', compact('categories'));
    }
}
