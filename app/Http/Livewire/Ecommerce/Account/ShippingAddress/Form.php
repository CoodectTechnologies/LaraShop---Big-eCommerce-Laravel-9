<?php

namespace App\Http\Livewire\Ecommerce\Account\ShippingAddress;

use App\Models\Country;
use App\Models\ShippingAddress;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Form extends Component
{
    public $user;
    public $shippingAddress;
    public $method;
    //Tools
    public $countryId;
    public $countries = [];
    public $states = [];

    protected function rules(){
        return [
            'shippingAddress.state_id' => 'required',
            'shippingAddress.municipality' => 'required',
            'shippingAddress.colony' => 'required',
            'shippingAddress.zip_code' => 'required|min:5|max:6',
            'shippingAddress.street' => 'required',
            'shippingAddress.street_number_int' => 'nullable',
            'shippingAddress.street_number_ext' => 'required',
            'shippingAddress.street_between' => 'nullable',
            'shippingAddress.street_references' => 'nullable',
            'shippingAddress.company' => 'nullable',
            'shippingAddress.name' => 'required',
            'shippingAddress.phone' => 'required',
            'shippingAddress.email' => 'required|email|unique:users,email,'.Auth::id() ?? null,
            'shippingAddress.default' => 'nullable',
        ];
    }
    public function mount(ShippingAddress $shippingAddress, $method){
        $this->user = User::find(Auth::id());
        $this->shippingAddress = $shippingAddress;
        $this->shippingAddress->load('state');
        $this->method = $method;
        $this->loadCountries();
    }
    public function render(){
        return view('livewire.ecommerce.account.shipping-address.form');
    }
    public function store(){
        $this->validate();
        $this->shippingAddress = $this->user->shippingAddresses()->create($this->shippingAddress->toArray());
        $this->validateDefault();
        session()->flash('alert', __('Registration successfully added'));
        session()->flash('alert-type', 'success');
        return Redirect::route('ecommerce.account.shipping-address.index');
    }
    public function update(){
        $this->validate();
        $this->shippingAddress->update();
        $this->validateDefault();
        session()->flash('alert', __('Registration successfully added'));
        session()->flash('alert-type', 'success');
        return Redirect::route('ecommerce.account.shipping-address.index');
    }
    private function loadCountries(){
        if($this->shippingAddress->state):
            $this->countryId = $this->shippingAddress->state->country->id;
        else:
            $country = Country::where('default', true)->first();
            $this->countryId = $country->id;
        endif;
        $this->countries = Country::orderByDesc('name')->where('status', true)->get();
        $this->loadStates($this->countryId);
    }
    public function loadStates($countryId){
        $this->states = State::orderByDesc('name')->where('country_id', $countryId)->get();
    }
    public function validateDefault(){
        if(!count($this->user->shippingAddresses)):
            $this->shippingAddress->default = true;
        else:
            if($this->shippingAddress->default):
                $this->user->shippingAddresses()
                ->where('id', '<>', $this->shippingAddress->id)
                ->update([
                    'default' => false
                ]);
            endif;
        endif;
    }
}
