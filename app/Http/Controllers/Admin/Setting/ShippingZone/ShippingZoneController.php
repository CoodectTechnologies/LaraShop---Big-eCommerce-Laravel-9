<?php

namespace App\Http\Controllers\Admin\Setting\ShippingZone;

use App\Http\Controllers\Controller;
use App\Models\ShippingZone;
use Illuminate\Http\Request;

class ShippingZoneController extends Controller
{
    public function index(){
        return view('admin.setting.shipping-zone.index');
    }
    public function create(){
        return view('admin.setting.shipping-zone.create');
    }
    public function edit(ShippingZone $shippingZone){
        return view('admin.setting.shipping-zone.edit', compact('shippingZone'));
    }
}
