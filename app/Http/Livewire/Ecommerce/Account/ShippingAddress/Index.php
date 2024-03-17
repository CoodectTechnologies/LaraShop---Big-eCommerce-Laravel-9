<?php

namespace App\Http\Livewire\Ecommerce\Account\ShippingAddress;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $user;

    public function mount(){
        $this->user = User::find(Auth::id());
        $this->user->load(['shippingAddresses.state.country']);
    }
    public function render(){
        $shippingAddresses = $this->user->shippingAddresses()->get();
        return view('livewire.ecommerce.account.shipping-address.index', compact('shippingAddresses'));
    }
}
