<?php

namespace App\Mail\Cart;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CartForgotten extends Mailable
{
    use Queueable, SerializesModels;

    private $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products){
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->subject('Carrito olvidado')->markdown('emails.cart.forgotten', [
            'products' => $this->products
        ]);
    }
}
