<?php

namespace App\Http\Livewire\Ecommerce\Account\ProductDigital;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $user;
    public $product;

    public function mount(Product $product){
        $this->user = User::find(Auth::id());
        $this->product = $product;
    }
    public function render(){
        return view('livewire.ecommerce.account.product-digital.show');
    }
    public function getFileDigital(){
        return $this->product->file_digital;
    }
}
