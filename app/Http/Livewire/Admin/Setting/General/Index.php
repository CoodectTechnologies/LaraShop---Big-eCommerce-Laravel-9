<?php

namespace App\Http\Livewire\Admin\Setting\General;

use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        return view('livewire.admin.setting.general.index');
    }
}
