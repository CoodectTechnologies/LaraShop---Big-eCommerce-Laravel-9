<?php

namespace App\Http\Livewire\Ecommerce\Account\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $user;

    public function mount(){
        $this->user = User::find(Auth::id());
    }
    public function render(){
        $orders = $this->user->orders()->with(['products'])->orderByDesc('id')->get();
        return view('livewire.ecommerce.account.order.index', compact('orders'));
    }
}
