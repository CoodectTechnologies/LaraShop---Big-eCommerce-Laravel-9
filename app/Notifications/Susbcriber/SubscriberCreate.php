<?php

namespace App\Notifications\Susbcriber;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class SubscriberCreate extends Notification
{
    use Queueable;

    private $subscriber;

    public function __construct(Subscriber $subscriber){
        $this->subscriber = $subscriber;
    }
    public function via($notifiable){
        return ['database'];
    }
    public function toArray($notifiable){
        return [
            'url' => route('admin.subscriber.index', ['search' => $this->subscriber->email]),
            'icon' => 'fa fa-users',
            'type' => 'success',
            'title' => 'Nuevo subscriptor',
            'body' => $this->subscriber->email.'  se ha suscrito'
        ];
    }
}
