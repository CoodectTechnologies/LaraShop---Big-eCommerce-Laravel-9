<?php

namespace App\Http\Livewire\Admin\Order\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $order;
    public $paymentStatus;
    public $status;

    protected function rules(){
        return [
            'order.payment_status' => 'required',
            'order.status' => 'required',
        ];
    }
    public function mount(Order $order){
        $this->order = $order;
        $this->paymentStatus = $order->payment_status;
        $this->status = $order->status;
        $this->order->load(['products', 'shippingAddress.state.country', 'billingAddress.state.country']);
    }
    public function render(){
        return view('livewire.admin.order.order.show');
    }
}
