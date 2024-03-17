<?php

namespace App\Http\Controllers\Ecommerce\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\PaymentGateways\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WebhookStripeController extends Controller
{
    public function __invoke(Request $request){
        if(!$request->data):
            return Redirect::back();
        endif;
        return StripeController::payment($request);
    }
}
