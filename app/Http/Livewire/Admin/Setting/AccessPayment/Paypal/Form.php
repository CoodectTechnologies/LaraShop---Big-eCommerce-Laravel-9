<?php

namespace App\Http\Livewire\Admin\Setting\AccessPayment\Paypal;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $paypalStatus;
    public $paypalClientId;

    protected function rules(){
        return [
            'paypalStatus' => 'nullable',
            'paypalClientId' => 'nullable'
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->paypalStatus = config('services.paypal.status');
        $this->paypalClientId = config('services.paypal.client_id');
    }
    public function render(){
        return view('livewire.admin.setting.access-payment.paypal.form');
    }
    public function update(){
        $this->validate();
        try{
            DotenvEditor::setKey('PAYPAL_STATUS', $this->paypalStatus)->save();
            DotenvEditor::setKey('PAYPAL_CLIENT_ID', $this->paypalClientId)->save();
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
