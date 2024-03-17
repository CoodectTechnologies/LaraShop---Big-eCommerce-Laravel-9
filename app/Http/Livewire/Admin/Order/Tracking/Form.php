<?php

namespace App\Http\Livewire\Admin\Order\Tracking;

use App\Models\Order;
use App\Models\OrderTracking;
use Livewire\Component;

class Form extends Component
{
    public $order;
    public $orderTracking;
    public $method;

    protected function rules(){
        return [
            'orderTracking.number_tracking' => 'required',
            'orderTracking.link_tracking' => 'nullable',
        ];
    }
    public function mount(Order $order, OrderTracking $orderTracking, $method){
        $this->order = $order;
        $this->orderTracking = $orderTracking;
        $this->method = $method;
    }
    public function render(){
        return view('livewire.admin.order.tracking.form');
    }
    public function store(){
        $this->validate();
        $this->order->orderTrackings()->create($this->orderTracking->toArray());
        $this->orderTracking = new OrderTracking();
        $this->emit('alert', 'success', __('Registration successfully added'));
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->orderTracking->update();
        $this->emit('alert', 'success', __('Registration successfully updated'));
        $this->emit('render');
    }
}
