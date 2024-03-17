<?php

namespace App\Http\Livewire\Ecommerce\Layouts;

use App\Models\TagAnalytic;
use Livewire\Component;

class TagAnalyticHeader extends Component
{
    public function render(){
        $tagAnalytic = TagAnalytic::getCache();
        return view('livewire.ecommerce.layouts.tag-analytic-header', compact('tagAnalytic'));
    }
}
