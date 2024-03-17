<?php

namespace App\Http\Controllers\Admin\Dashboard\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('admin.dashboard.order.index');
    }
}
