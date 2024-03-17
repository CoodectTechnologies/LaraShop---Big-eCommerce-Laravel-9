<?php

namespace App\Http\Livewire\Admin\Setting\Contact;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $phone;
    public $email;
    public $facebook;
    public $twitter;
    public $instagram;
    public $youtube;
    public $whatsapp;
    public $linkedin;
    public $map;

    protected function rules(){
        return [
            'phone' => 'required',
            'email' => 'required',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'whatsapp' => 'nullable',
            'linkedin' => 'nullable',
            'map' => 'nullable',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->phone = config('contact.phone');
        $this->email = config('contact.email');
        $this->facebook = config('contact.facebook');
        $this->twitter = config('contact.twitter');
        $this->instagram = config('contact.instagram');
        $this->youtube = config('contact.youtube');
        $this->whatsapp = config('contact.whatsapp');
        $this->linkedin = config('contact.linkedin');
        $this->map = config('contact.map');
    }
    public function render(){
        return view('livewire.admin.setting.contact.form');
    }
    public function update(){
        $this->validate();
        try{
            DotenvEditor::setKey('CONTACT_PHONE', $this->phone)->save();
            DotenvEditor::setKey('CONTACT_EMAIL', $this->email)->save();
            DotenvEditor::setKey('CONTACT_FACEBOOK', $this->facebook)->save();
            DotenvEditor::setKey('CONTACT_TWITTER', $this->twitter)->save();
            DotenvEditor::setKey('CONTACT_INSTAGRAM', $this->instagram)->save();
            DotenvEditor::setKey('CONTACT_YOUTUBE', $this->youtube)->save();
            DotenvEditor::setKey('CONTACT_WHATSAPP', $this->whatsapp)->save();
            DotenvEditor::setKey('CONTACT_LINKEDIN', $this->linkedin)->save();
            DotenvEditor::setKey('CONTACT_MAP_IFRAME', $this->map)->save();
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
