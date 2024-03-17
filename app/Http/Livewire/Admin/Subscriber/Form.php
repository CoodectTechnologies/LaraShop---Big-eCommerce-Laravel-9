<?php

namespace App\Http\Livewire\Admin\Subscriber;

use App\Models\Subscriber;
use Livewire\Component;

class Form extends Component
{

    public $subscriber;
    public $method;
    public $imageTmp;

    protected function rules(){
        return [
            'subscriber.email' => 'required|email|unique:subscribers,email,'.$this->subscriber->id,
        ];
    }
    public function mount(Subscriber $subscriber, $method){
        $this->subscriber = $subscriber;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.subscriber.form');
    }
    public function store(){
        $this->validate();
        $this->subscriber->save();
        $this->subscriber = new Subscriber();
        $this->emit('alert', 'success', 'Subscriptor agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->subscriber->update();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
}
