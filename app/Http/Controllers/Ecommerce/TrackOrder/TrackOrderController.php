<?php

namespace App\Http\Controllers\Ecommerce\TrackOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrackOrderController extends Controller
{
    public function index(){
        return view('ecommerce.track-order.index');
    }
}
