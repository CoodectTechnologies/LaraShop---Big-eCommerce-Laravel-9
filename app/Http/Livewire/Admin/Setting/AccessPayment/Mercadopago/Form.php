<?php

namespace App\Http\Livewire\Admin\Setting\AccessPayment\Mercadopago;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Component;

class Form extends Component
{
    public $method;
    public $mercadoStatus;
    public $mercadoPagoKey;
    public $mercadoPagoToken;
    public $mercadoPagoCountryCode;
    public $mercadoPagoCurrencyCode;

    protected function rules(){
        return [
            'mercadoStatus' => 'nullable',
            'mercadoPagoKey' => 'nullable',
            'mercadoPagoToken' => 'nullable',
            'mercadoPagoCountryCode' => 'nullable',
            'mercadoPagoCurrencyCode' => 'nullable',
        ];
    }
    public function mount($method){
        $this->method = $method;
        $this->mercadoStatus = config('services.mercadopago.status');
        $this->mercadoPagoKey = config('services.mercadopago.key');
        $this->mercadoPagoToken = config('services.mercadopago.token');
        $this->mercadoPagoCountryCode = config('services.mercadopago.country_code');
        $this->mercadoPagoCurrencyCode = config('services.mercadopago.currency_code');
    }
    public function render(){
        return view('livewire.admin.setting.access-payment.mercadopago.form');
    }
    public function update(){
        $this->validate();
        try{
            //Mercado pago
            DotenvEditor::setKey('MERCADOPAGO_STATUS', $this->mercadoStatus)->save();
            DotenvEditor::setKey('MERCADOPAGO_PUBLIC_KEY', $this->mercadoPagoKey)->save();
            DotenvEditor::setKey('MERCADOPAGO_ACCESS_TOKEN', $this->mercadoPagoToken)->save();
            DotenvEditor::setKey('MERCADOPAGO_COUNTRY_CODE', $this->mercadoPagoCountryCode)->save();
            DotenvEditor::setKey('MERCADOPAGO_CURRENCY_CODE', $this->mercadoPagoCurrencyCode)->save();
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
    public function countriesCodeAllowed(){
        return ['es-MX', 'es-AR', 'pt-BR', 'es-CL', 'es-CO', 'es-PE', 'es-UY'];
    }
    public function currenciesCodeAllowed(){
        return ['MXN', 'ARS', 'BRL', 'CLP', 'COP', 'PEN', 'UYU'];
    }
}
