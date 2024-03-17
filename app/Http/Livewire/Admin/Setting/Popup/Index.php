<?php

namespace App\Http\Livewire\Admin\Setting\Popup;

use App\Models\Popup;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $popup = Popup::orderByDesc('id')->first() ?? new Popup();
        return view('livewire.admin.setting.popup.index', compact('popup'));
    }
}
