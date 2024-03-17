<?php

namespace App\Http\Livewire\Admin\Setting\AccessGoogle;

use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        return view('livewire.admin.setting.access-google.index');
    }
}
