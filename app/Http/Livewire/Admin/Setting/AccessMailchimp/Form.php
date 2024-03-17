<?php

namespace App\Http\Livewire\Admin\Setting\AccessMailchimp;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class Form extends Component
{
    public $method;
    public $mailchimpStatus;
    public $mailchimpApiKey;
    public $mailchimpListId;

    protected function rules(){
        return [
            'mailchimpStatus' => 'nullable',
            'mailchimpApiKey' => 'nullable',
            'mailchimpListId' => 'nullable',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->mailchimpStatus = config('newsletter.status');
        $this->mailchimpApiKey = config('newsletter.apiKey');
        $this->mailchimpListId = config('newsletter.lists.subscribers.id');
    }
    public function render(){
        return view('livewire.admin.setting.access-mailchimp.form');
    }
    public function update(){
        $this->validate();
        try{
            //PayPal
            DotenvEditor::setKey('MAILCHIMP_STATUS', $this->mailchimpStatus)->save();
            DotenvEditor::setKey('MAILCHIMP_APIKEY', $this->mailchimpApiKey)->save();
            DotenvEditor::setKey('MAILCHIMP_LIST_ID', $this->mailchimpListId)->save();
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
