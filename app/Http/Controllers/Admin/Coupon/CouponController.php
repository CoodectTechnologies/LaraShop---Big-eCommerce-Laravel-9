<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        return view('admin.coupon.index');
    }
    public function create(){
        return view('admin.coupon.create');
    }
    public function edit(Coupon $coupon){
        return view('admin.coupon.edit', compact('coupon'));
    }
}
