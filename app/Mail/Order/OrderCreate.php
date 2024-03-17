<?php

namespace App\Mail\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreate extends Mailable
{
    use Queueable, SerializesModels;

    private $order;

    public function __construct(Order $order){
        $this->order = $order;
        $this->order->load('products');
    }
    public function build(){
        return $this->subject('Orden: #'.$this->order->number.' recibida')
        ->markdown('emails.order.create', [
            'order' => $this->order
        ]);
    }
}
