<?php

namespace App\Http\Livewire\Admin\User\ShippingBilling;

use App\Models\BillingAddress;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Livewire\Component;

class Form extends Component
{
    protected $listeners = ['buildUserByEvent'];

    public $user;
    public $billingAddress;
    public $method;
    public $countryId;

    protected function rules(){
        return [
            'countryId' => 'required',
            'billingAddress.state_id' => 'required',
            'billingAddress.vat' => 'required',
            'billingAddress.municipality' => 'required',
            'billingAddress.colony' => 'required',
            'billingAddress.zip_code' => 'required|min:5',
            'billingAddress.street' => 'required',
            'billingAddress.street_number_int' => 'nullable',
            'billingAddress.street_number_ext' => 'required',
            'billingAddress.street_between' => 'nullable',
            'billingAddress.street_references' => 'nullable',
            'billingAddress.company' => 'nullable',
            'billingAddress.name' => 'required',
            'billingAddress.phone' => 'nullable',
            'billingAddress.email' => 'required|email',
            'billingAddress.default' => 'nullable',
        ];
    }
    public function mount(User $user, BillingAddress $billingAddress, $method){
        $this->user = $user;
        $this->billingAddress = $billingAddress;
        $this->billingAddress->load('state');
        $this->method = $method;
        $this->countryId = isset($this->billingAddress->state->country->id) ? $this->billingAddress->state->country->id : 142 ; // 142 <- méxico
    }
    public function render(){
        $countries = Country::orderBy('id', 'desc')->where('status', true)->get();
        $states = State::orderBy('id');
        if($this->countryId):
            $states = $states->where('country_id', $this->countryId);
        endif;
        $states = $states->get();
        return view('livewire.admin.user.shipping-billing.form', compact('countries', 'states'));
    }
    public function store(){
        $this->validate();
        $this->validateAddressDefault();
        $this->user->billingAddresses()->create($this->billingAddress->toArray());
        $this->billingAddress = new BillingAddress();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->validateAddressDefault();
        $this->billingAddress->update();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function storeCustom(){
        $this->validate();
        $this->validateAddressDefault();
        $this->billingAddress->user_id = $this->user ? $this->user->id : null;
        $this->billingAddress->save();
        $this->emit('eventBillingAddressCreate', $this->billingAddress->id);
    }
    public function validateAddressDefault(){
        if(!count($this->user->billingAddresses)):
            $this->billingAddress->default = true;
        else:
            if($this->billingAddress->default):
                $this->user->billingAddresses()->update([
                    'default' => false
                ]);
            endif;
        endif;
    }
    public function buildUserByEvent($userId){
        if($userId):
            $this->user = User::find($userId);
        else:
            $this->user = new User();
        endif;
    }
}
