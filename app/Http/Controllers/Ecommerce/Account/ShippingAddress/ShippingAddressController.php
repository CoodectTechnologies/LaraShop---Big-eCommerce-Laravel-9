<?php

namespace App\Http\Controllers\Ecommerce\Account\ShippingAddress;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function __construct(){
        $this->middleware('shippingAddress')->only('edit');
    }
    public function index(){
        return view('ecommerce.account.shipping-address.index');
    }
    public function create(){
        return view('ecommerce.account.shipping-address.create');
    }
    public function edit(ShippingAddress $shippingAddress){
        return view('ecommerce.account.shipping-address.edit', compact('shippingAddress'));
    }
}
