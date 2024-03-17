<?php

namespace App\Http\Livewire\Admin\User\ShippingAddress;

use App\Models\ShippingAddress;
use Livewire\Component;
use App\Models\User;
use Exception;

class Index extends Component
{
    protected $listeners = ['render'];

    public $user;

    public function mount(User $user){
        $this->user = $user;
        $this->user->load(['shippingAddresses.state.country', 'orders']);
    }
    public function render(){
        $shippingAddresses = $this->user->shippingAddresses()->orderByDesc('id')->get();
        return view('livewire.admin.user.shipping-address.index', compact('shippingAddresses'));
    }
    public function destroy(ShippingAddress $shippingAddress){
        try{
            if(!count($shippingAddress->orders)):
                $shippingAddress->delete();
                $this->emit('alert', 'success', __('Successful elimination'));
            else:
                $this->emit('alert', 'warning', __('You cannot delete this address because it is related to an order.'));
            endif;
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
