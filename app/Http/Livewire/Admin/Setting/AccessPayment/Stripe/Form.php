<?php

namespace App\Http\Livewire\Admin\Setting\AccessPayment\Stripe;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $stripeStatus;
    public $stripePublic;
    public $stripeSecret;

    protected function rules(){
        return [
            'stripeStatus' => 'nullable',
            'stripePublic' => 'nullable',
            'stripeSecret' => 'nullable'
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->stripeStatus = config('services.stripe.status');
        $this->stripePublic = config('services.stripe.public');
        $this->stripeSecret = config('services.stripe.secret');
    }
    public function render(){
        return view('livewire.admin.setting.access-payment.stripe.form');
    }
    public function update(){
        $this->validate();
        try{
            DotenvEditor::setKey('STRIPE_STATUS', $this->stripeStatus)->save();
            DotenvEditor::setKey('STRIPE_PUBLIC_KEY', $this->stripePublic)->save();
            DotenvEditor::setKey('STRIPE_SECRET_KEY', $this->stripeSecret)->save();
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
