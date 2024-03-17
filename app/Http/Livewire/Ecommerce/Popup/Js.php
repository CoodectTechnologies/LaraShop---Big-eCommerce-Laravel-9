<?php

namespace App\Http\Livewire\Ecommerce\Popup;

use App\Models\Popup;
use Livewire\Component;

class Js extends Component
{
    public function render(){
        $popup = Popup::orderByDesc('id')->first() ?? new Popup();
        return view('livewire.ecommerce.popup.js', compact('popup'));
    }
}
