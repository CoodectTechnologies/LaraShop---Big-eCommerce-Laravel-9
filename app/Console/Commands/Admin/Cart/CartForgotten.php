<?php

namespace App\Console\Commands\Admin\Cart;

use App\Mail\Cart\CartForgotten as CartCartForgotten;
use App\Models\Product;
use App\Models\Shoppingcart;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CartForgotten extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:forgotten';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to all users who have forgotten cart';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        $shoppingCarts = Shoppingcart::whereDate('created_at', date('Y-m-d'))->get();
        foreach($shoppingCarts as $shoppingCart):
            $products = [];
            $items = unserialize($shoppingCart->content);
            foreach($items as $item):
                $product = Product::find($item->id);
                $products[] = $product;
            endforeach;
            $user = User::find($shoppingCart->identifier);
            Mail::to($user->email)->send(new CartCartForgotten($products));
        endforeach;
    }
}
