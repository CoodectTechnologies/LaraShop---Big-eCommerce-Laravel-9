<?php

namespace App\Notifications\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreate extends Notification
{
    use Queueable;

    private $order;

    public function __construct(Order $order){
        $this->order = $order;
        $this->order->load('products');
    }
    public function via($notifiable){
        return ['database', 'mail'];
    }
    public function toMail($notifiable){
        return (new MailMessage)
        ->subject('Notificación de Pedido - '.$this->order->number)
        ->markdown('emails.order.create-admin', [
            'order' => $this->order,
            'user' => $notifiable
        ]);
    }
    public function toArray($notifiable){
        return [
            'url' => route('admin.order.show', $this->order),
            'icon' => 'fas fa-shopping-bag',
            'type' => 'success',
            'title' => 'Nueva orden '.$this->order->number,
            'body' => 'Estado de pago: '.$this->order->paymentStatusToString()
        ];
    }
}
