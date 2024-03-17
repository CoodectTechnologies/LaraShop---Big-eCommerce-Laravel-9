<?php

namespace App\Http\Livewire\Ecommerce\Account\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $user;
    public $order;

    public function mount(Order $order){
        $this->user = User::find(Auth::id());
        $this->order = $order;
        $this->order->load(['products', 'shippingAddress.state.country', 'billingAddress.state.country']);
    }
    public function render(){
        return view('livewire.ecommerce.account.order.show');
    }
}
