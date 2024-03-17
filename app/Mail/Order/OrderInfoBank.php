<?php

namespace App\Mail\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInfoBank extends Mailable
{
    use Queueable, SerializesModels;

    private $order;

    public function __construct(Order $order){
        $this->order = $order;
    }
    public function build(){
        return $this->subject('Datos bancarios: #'.$this->order->number)
        ->markdown('emails.order.info-bank', [
            'order' => $this->order
        ]);
    }
}
