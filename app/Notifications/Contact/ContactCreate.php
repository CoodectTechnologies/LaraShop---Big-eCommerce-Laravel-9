<?php

namespace App\Notifications\Contact;

use App\Models\EmailWeb;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ContactCreate extends Notification
{
    use Queueable;

    private $emailWeb;

    public function __construct(EmailWeb $emailWeb){
        $this->emailWeb = $emailWeb;
    }
    public function via($notifiable){
        return ['database'];
    }
    public function toArray($notifiable){
        return [
            'url' => route('admin.email-web.index'),
            'icon' => 'fa fa-user',
            'type' => 'success',
            'title' => 'Nuevo mensaje web ',
            'body' => $this->emailWeb->name.' quiere contactar'
        ];
    }
}
