<?php

namespace App\Http\Controllers\Ecommerce\Account\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('order')->only('show');
    }
    public function index(){
        return view('ecommerce.account.order.index');
    }
    public function show(Order $order){
        return view('ecommerce.account.order.show', compact('order'));
    }
}
