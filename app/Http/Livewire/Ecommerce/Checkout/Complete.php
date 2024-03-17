<?php

namespace App\Http\Livewire\Ecommerce\Checkout;

use App\Models\Order;
use Livewire\Component;

class Complete extends Component
{
    public $order;

    public function mount(Order $order){
        $this->order = $order;
        $this->order->load(['products', 'shippingAddress.state.country', 'billingAddress.state.country']);
    }
    public function render(){
        return view('livewire.ecommerce.checkout.complete');
    }
}
