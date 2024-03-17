<?php

namespace App\Http\Livewire\Admin\User\ShippingBilling;

use App\Models\BillingAddress;
use App\Models\ShippingBilling;
use App\Models\User;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public $user;

    public function mount(User $user){
        $this->user = $user;
        $this->user->load(['billingAddresses.state.country', 'orders']);
    }
    public function render(){
        $billingAddresses = $this->user->billingAddresses()->orderByDesc('id')->get();
        return view('livewire.admin.user.shipping-billing.index', compact('billingAddresses'));
    }
    public function destroy(BillingAddress $billingAddress){
        try{
            if(!count($billingAddress->orders)):
                $billingAddress->delete();
                $this->emit('alert', 'success', __('Successful elimination'));
            else:
                $this->emit('alert', 'warning', __('You cannot delete this address because it is related to an order.'));
            endif;
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
