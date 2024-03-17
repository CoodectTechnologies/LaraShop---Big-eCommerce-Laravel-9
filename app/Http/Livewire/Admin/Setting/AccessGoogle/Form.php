<?php

namespace App\Http\Livewire\Admin\Setting\AccessGoogle;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class Form extends Component
{
    public $method;
    public $googleStatus;
    public $googleClientId;
    public $googleClientSecret;

    protected function rules(){
        return [
            'googleStatus' => 'nullable',
            'googleClientId' => 'nullable',
            'googleClientSecret' => 'nullable',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->googleStatus = config('services.google.status');
        $this->googleClientId = config('services.google.client_id');
        $this->googleClientSecret = config('services.google.client_secret');
    }
    public function render(){
        return view('livewire.admin.setting.access-google.form');
    }
    public function update(){
        $this->validate();
        try{
            //PayPal
            DotenvEditor::setKey('GOOGLE_STATUS', $this->googleStatus)->save();
            DotenvEditor::setKey('GOOGLE_CLIENT_ID', $this->googleClientId)->save();
            DotenvEditor::setKey('GOOGLE_CLIENT_SECRET', $this->googleClientSecret)->save();
            DotenvEditor::deleteBackups();
            if (file_exists(App::getCachedConfigPath())):
                Artisan::call("config:cache");
            endif;
            $this->emit('alert', 'success', 'Accesos actualizados con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
        $this->emit('render');
    }
}
