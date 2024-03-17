<?php

namespace App\Http\Livewire\Ecommerce\Subscriber;

use App\Models\Subscriber;
use App\Models\User;
use App\Notifications\Susbcriber\SubscriberCreate;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Index extends Component
{
    public $email;

    public function render(){
        return view('livewire.ecommerce.subscriber.index');
    }
    public function store(){
        $this->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);
        $subscriber = Subscriber::create([
            'email' => $this->email,
        ]);
        Notification::send(
            User::permission(['subscriptores'])->get(),
            new SubscriberCreate($subscriber)
        );
        $this->reset('email');
        session()->flash('alert-type-subscriber', 'success');
        session()->flash('alert-subscriber', 'Excelente, ahora estarás al tanto de cuando haya alguna oferta.');
    }
}
