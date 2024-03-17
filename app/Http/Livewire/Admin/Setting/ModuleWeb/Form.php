<?php

namespace App\Http\Livewire\Admin\Setting\ModuleWeb;

use App\Models\ModuleWeb;
use Livewire\Component;

class Form extends Component
{
    public $moduleWeb;
    public $method;
    
    public function mount(ModuleWeb $moduleWeb, $method){
        $this->moduleWeb = $moduleWeb;
        $this->method = $method;
    }
    protected function rules(){
        return [
            'moduleWeb.name' => 'required|unique:module_webs,name,'.$this->moduleWeb->id,
        ];
    }
    public function render(){
        return view('livewire.admin.setting.module-web.form');
    }
    public function store(){
        $this->validate();
        $this->moduleWeb->save();
        $this->emit('alert', 'success', 'Módulo web agregado con éxito');
        $this->emit('render');
        $this->moduleWeb = new ModuleWeb();
    }
    public function update(){
        $this->validate();
        $this->moduleWeb->update();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
}
