<?php

namespace App\Http\Livewire\Admin\Order\Status;

use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use Livewire\Component;
use App\Models\Order;
use Exception;

class Form extends Component
{
    public $order;
    public $statusOld;
    public $paymentStatusOld;

    protected function rules(){
        return [
            'order.payment_status' => 'required',
            'order.status' => 'required',
        ];
    }
    public function mount(Order $order){
        $this->order = $order;
        $this->order->load('shippingAddress');
        $this->paymentStatusOld = $this->order->payment_status;
        $this->statusOld = $this->order->status;
    }
    public function render(){
        return view('livewire.admin.order.status.form');
    }
    public function update(){
        $this->validate();
        try{
            if($this->order->status != $this->statusOld):
                $this->statusOld = $this->order->status;
                CheckoutController::sendEmailStatus($this->order);
            endif;
            if(
                $this->paymentStatusOld != 'Aprobado' &&
                $this->order->payment_status == 'Aprobado'
            ):
                $this->paymentStatusOld = $this->order->payment_status;
                CheckoutController::decrementStock($this->order);
            else:
                if(
                    $this->paymentStatusOld == 'Aprobado' &&
                    $this->order->payment_status != 'Aprobado'
                ):
                    $this->paymentStatusOld = $this->order->payment_status;
                    CheckoutController::decrementStock($this->order, $reverse=true);
                else:
                    $this->paymentStatusOld = $this->order->payment_status;
                endif;
            endif;
            $this->emit('alert', 'success', 'Información actualizada con éxito');
        }catch(Exception $e){
            $this->emit('alert', 'success', 'No se envío el correo de notificación: '.$e->getMessage());
        }
        $this->order->update();
    }
    public function paymentStatuses(){
        return [
            Order::PAYMENT_STATUS_APPROVED,
            Order::PAYMENT_STATUS_PENDING,
            Order::PAYMENT_STATUS_REJECTED
        ];
    }
    public function statuses(){
        return [
            Order::STATUS_CONFIRMED,
            Order::STATUS_PROCESSING,
            Order::STATUS_SENT,
            Order::STATUS_COMPLETED,
            Order::STATUS_CANCELED,
            Order::STATUS_REFUND,
        ];
    }
}
