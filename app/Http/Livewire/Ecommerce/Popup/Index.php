<?php

namespace App\Http\Livewire\Ecommerce\Popup;

use App\Models\Popup;
use Livewire\Component;

class Index extends Component
{
    public $popup;

    public function mount(Popup $popup){
        $this->popup = $popup;
    }
    public function render(){
        return view('livewire.ecommerce.popup.index');
    }
}
