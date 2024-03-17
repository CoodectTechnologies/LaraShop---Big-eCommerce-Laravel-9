<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreate extends Notification
{
    use Queueable;

    private $user;
    private $password;

    public function __construct(User $user, $password){
        $this->user = $user;
        $this->password = $password;
    }
    public function via($notifiable){
        return ['database', 'mail'];
    }
    public function toMail($notifiable){
        return (new MailMessage)
        ->greeting('Hola '.$notifiable->name)
        ->subject('Bienvenido a '.config('app.name'))
        ->line('Tu correo es: '.$this->user->email)
        ->line('Tu contraseña es: '.$this->password)
        ->action('Cambia tu contraseña por una personalizada', route('ecommerce.account.profile.index'));
    }
    public function toArray($notifiable){
        return [
            'url' =>  route('login'),
            'icon' => 'fa fa-user',
            'type' => 'success',
            'title' => 'Bienvenido a '.config('app.name'),
            'body' => 'Tu correo es: '.$this->user->email.' '.'Tu contraseña es: '.$this->password
        ];
    }
}
