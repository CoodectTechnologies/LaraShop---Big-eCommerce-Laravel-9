<?php

namespace App\Http\Livewire\Ecommerce\Account\ProductDigital;

use App\Models\Product;
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
        $productsDigitals = $this->user->getDigitalProducts();
        return view('livewire.ecommerce.account.product-digital.index', compact('productsDigitals'));
    }
}
