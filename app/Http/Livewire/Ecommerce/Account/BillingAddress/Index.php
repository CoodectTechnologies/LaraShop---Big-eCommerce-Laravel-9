<?php

namespace App\Http\Livewire\Ecommerce\Account\BillingAddress;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $user;

    public function mount(){
        $this->user = User::find(Auth::id());
        $this->user->load(['billingAddresses.state.country']);
    }
    public function render(){
        $billingAddresses = $this->user->billingAddresses()->get();
        return view('livewire.ecommerce.account.billing-address.index', compact('billingAddresses'));
    }
}
