<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\Checkout\CheckoutController;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Comment\CommentCreate as NotificationCommentCreate;
use App\Mail\Comment\CommentCreate as MailCommentCreate;
use App\Models\Comment;
use App\Models\ConfiguratorBudget;
use App\Models\ConfiguratorCompatibility;
use App\Models\ConfiguratorStage;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shoppingcart;
use App\Models\State;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Stripe\StripeClient;

class TestController extends Controller
{
    public function index(){
        //Your code test here
    }
    public static function test(){
        $order = Order::find(7);
        CheckoutController::sendEmail($order);
    }
}
