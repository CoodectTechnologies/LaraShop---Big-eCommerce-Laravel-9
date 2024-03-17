<?php

namespace App\Http\Livewire\Admin\Order\Email;

use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use App\Models\Order;
use Livewire\Component;

class Resend extends Component
{
    public $order;

    public function mount(Order $order){
        $this->order = $order;
    }
    public function render(){
        return view('livewire.admin.order.email.resend');
    }
    public function sendEmail(){
        CheckoutController::sendEmail($this->order);
    }
}
