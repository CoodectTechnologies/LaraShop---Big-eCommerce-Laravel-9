<?php

namespace App\Http\Livewire\Admin\Order\Tracking;

use App\Mail\Order\OrderTrackingNumber;
use App\Models\Order;
use App\Models\OrderTracking;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public $order;

    public function mount(Order $order){
        $this->order = $order;
        $this->order->load('orderTrackings');
    }
    public function render(){
        $orderTrackings = $this->order->orderTrackings()->orderByDesc('id')->get();
        return view('livewire.admin.order.tracking.index', compact('orderTrackings'));
    }
    public function sendNumberTrackings(){
        $orderTrackings = $this->order->orderTrackings()->get();
        if(count($orderTrackings)):
            try{
                Mail::to($this->order->shippingAddress->email)->send(new OrderTrackingNumber($this->order, $orderTrackings));
                $this->order->send_email_track = true;
                $this->order->send_email_track_error = null;
                $this->order->update();
                $this->emit('alert', 'success', 'Números de guia enviados');
            }catch(Exception $e){
                $this->order->send_email_track = false;
                $this->order->send_email_track_error = $e->getMessage();
                $this->order->update();
                $this->emit('alert', 'warning', $e->getMessage());
            }
        else:
            $this->emit('alert', 'warning', 'Sin números de guia');
        endif;
    }
    public function destroy(OrderTracking $orderTracking){
        try{
            $orderTracking->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
