<?php

namespace App\Http\Controllers\Ecommerce\Account\BillingAddress;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use Illuminate\Http\Request;

class BillingAddressController extends Controller
{
    public function __construct(){
        $this->middleware('billingAddress')->only('edit');
    }
    public function index(){
        return view('ecommerce.account.billing-address.index');
    }
    public function create(){
        return view('ecommerce.account.billing-address.create');
    }
    public function edit(BillingAddress $billingAddress){
        return view('ecommerce.account.billing-address.edit', compact('billingAddress'));
    }
}
