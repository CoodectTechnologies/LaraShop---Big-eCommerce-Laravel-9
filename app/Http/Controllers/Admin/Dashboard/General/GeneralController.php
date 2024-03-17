<?php

namespace App\Http\Controllers\Admin\Dashboard\General;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Admin\Order\OrderNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class GeneralController extends Controller
{
    public function index(){
        return view('admin.dashboard.general.index');
    }
}
