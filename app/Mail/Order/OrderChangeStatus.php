<?php

namespace App\Mail\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderChangeStatus extends Mailable
{
    use Queueable, SerializesModels;

    private $order;

    public function __construct(Order $order){
        $this->order = $order;
    }
    public function build(){
        return $this->subject('Se actualizo el status: '.$this->order->number)
        ->markdown('emails.order.change-status', [
            'order' => $this->order
        ]);
    }
}
