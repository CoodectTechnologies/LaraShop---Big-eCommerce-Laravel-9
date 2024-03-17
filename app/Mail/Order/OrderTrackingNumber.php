<?php

namespace App\Mail\Order;

use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderTrackingNumber extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $orderTrackings;

    public function __construct(Order $order, $orderTrackings){
        $this->order = $order;
        $this->orderTrackings = $orderTrackings;
    }
    public function build(){
        return $this->subject('Números de rastreo: #'.$this->order->number)
        ->markdown('emails.order.tracking', [
            'order' => $this->order,
            'orderTrackings' => $this->orderTrackings
        ]);
    }
}
