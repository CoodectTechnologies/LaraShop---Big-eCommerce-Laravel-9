<?php

namespace App\Http\Livewire\Admin\Setting\AccessPayment\Transfer;

use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Exception;

class Form extends Component
{
    public $method;
    public $paymentStatus;
    public $paymentBank;
    public $paymentAccountBank;
    public $paymentTarget;
    public $paymentName;

    protected function rules(){
        return [
            'paymentStatus' => 'required',
            'paymentAccountBank' => 'required',
            'paymentTarget' => 'required',
            'paymentBank' => 'required',
            'paymentName' => 'required',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->paymentStatus = config('services.transfer.status');
        $this->paymentAccountBank = config('services.transfer.account_bank');
        $this->paymentTarget = config('services.transfer.target');
        $this->paymentBank = config('services.transfer.bank');
        $this->paymentName = config('services.transfer.name');
    }
    public function render(){
        return view('livewire.admin.setting.access-payment.transfer.form');
    }
    public function update(){
        $this->validate();
        try{
            DotenvEditor::setKey('TRANSFER_STATUS', $this->paymentStatus)->save();
            DotenvEditor::setKey('TRANSFER_BANK', $this->paymentBank)->save();
            DotenvEditor::setKey('TRANSFER_ACCOUNT_BANK', $this->paymentAccountBank)->save();
            DotenvEditor::setKey('TRANSFER_TARGET', $this->paymentTarget)->save();
            DotenvEditor::setKey('TRANSFER_NAME', $this->paymentName)->save();
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
