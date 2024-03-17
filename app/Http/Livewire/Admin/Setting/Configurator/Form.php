<?php

namespace App\Http\Livewire\Admin\Setting\Configurator;

use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Exception;

class Form extends Component
{
    public $method;
    public $active;
    public $budgetActive;

    protected function rules(){
        return [
            'active' => 'required',
            'budgetActive' => 'required',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->active = config('configurator.active');
        $this->budgetActive = config('configurator.budget_active');
    }
    public function render(){
        return view('livewire.admin.setting.configurator.form');
    }
    public function update(){
        $this->validate();
        try{
            DotenvEditor::setKey('CONFIGURATOR_ACTIVE', $this->active)->save();
            DotenvEditor::setKey('CONFIGURATOR_BUDGET_ACTIVE', $this->budgetActive)->save();
            DotenvEditor::deleteBackups();
            if (file_exists(App::getCachedConfigPath())):
                Artisan::call("config:cache");
            endif;
            $this->emit('alert', 'success', __('Registration successfully updated'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
        $this->emit('render');
    }
}
