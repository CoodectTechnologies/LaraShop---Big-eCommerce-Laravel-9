<?php

namespace App\Http\Livewire\Ecommerce\TrackOrder;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{
    public $orderNumber;
    public $order;

    protected function rules(){
        return [
            'orderNumber' => 'required|exists:orders,number'
        ];
    }
    public function render(){
        return view('livewire.ecommerce.track-order.index');
    }
    public function trackOrder(){
        $this->validate();
        $this->order = Order::where('number', $this->orderNumber)->first();
    }
}
