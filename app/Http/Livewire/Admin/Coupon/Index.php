<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Exception;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['render'];

    public function render(){
        $coupons = Coupon::query()->with(['orders'])->orderBy('id', 'desc')->get();
        return view('livewire.admin.coupon.index', compact('coupons'));
    }
    public function destroy(Coupon $coupon){
        try{
            $coupon->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
