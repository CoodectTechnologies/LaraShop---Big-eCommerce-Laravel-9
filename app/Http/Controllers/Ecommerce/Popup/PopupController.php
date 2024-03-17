<?php

namespace App\Http\Controllers\Ecommerce\Popup;

use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    public function index(){
        $popup = Popup::orderByDesc('id')->first() ?? new Popup();
        return view('ecommerce.popup.index', compact('popup'));
    }
}
