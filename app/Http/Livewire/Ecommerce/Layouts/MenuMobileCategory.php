<?php

namespace App\Http\Livewire\Ecommerce\Layouts;

use App\Models\ProductCategory;
use Livewire\Component;

class MenuMobileCategory extends Component
{
    public function render(){
        $categories = ProductCategory::getCache();
        return view('livewire.ecommerce.layouts.menu-mobile-category', compact('categories'));
    }
}
