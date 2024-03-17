<?php

namespace App\Http\Livewire\Ecommerce\Account\BillingAddress;

use App\Models\BillingAddress;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Form extends Component
{
    public $user;
    public $billingAddress;
    public $method;
    //Tools
    public $countryId;
    public $countries = [];
    public $states = [];

    protected function rules(){
        return [
            'billingAddress.state_id' => 'required',
            'billingAddress.municipality' => 'required',
            'billingAddress.colony' => 'required',
            'billingAddress.zip_code' => 'required|min:5|max:6',
            'billingAddress.street' => 'required',
            'billingAddress.street_number_int' => 'nullable',
            'billingAddress.street_number_ext' => 'required',
            'billingAddress.street_between' => 'nullable',
            'billingAddress.street_references' => 'nullable',
            'billingAddress.vat' => 'required|min:12|max:13',
            'billingAddress.company' => 'nullable',
            'billingAddress.name' => 'required',
            'billingAddress.phone' => 'required',
            'billingAddress.email' => 'required|email|unique:users,email,'.Auth::id() ?? null,
            'billingAddress.default' => 'nullable',
        ];
    }
    public function mount(BillingAddress $billingAddress, $method){
        $this->user = User::find(Auth::id());
        $this->billingAddress = $billingAddress;
        $this->billingAddress->load('state');
        $this->method = $method;
        $this->loadCountries();
    }
    public function render(){
        return view('livewire.ecommerce.account.billing-address.form');
    }
    public function store(){
        $this->validate();
        $this->billingAddress = $this->user->billingAddresses()->create($this->billingAddress->toArray());
        $this->validateDefault();
        session()->flash('alert', __('Registration successfully added'));
        session()->flash('alert-type', 'success');
        return Redirect::route('ecommerce.account.billing-address.index');
    }
    public function update(){
        $this->validate();
        $this->billingAddress->update();
        $this->validateDefault();
        session()->flash('alert', __('Registration successfully added'));
        session()->flash('alert-type', 'success');
        return Redirect::route('ecommerce.account.billing-address.index');
    }
    private function loadCountries(){
        if($this->billingAddress->state):
            $this->countryId = $this->billingAddress->state->country->id;
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
        if(!count($this->user->billingAddresses)):
            $this->billingAddress->default = true;
        else:
            if($this->billingAddress->default):
                $this->user->billingAddresses()
                ->where('id', '<>', $this->billingAddress->id)
                ->update([
                    'default' => false
                ]);
            endif;
        endif;
    }
}
