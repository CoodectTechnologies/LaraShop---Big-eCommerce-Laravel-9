<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('shipping_address_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('billing_address_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null');
            $table->string('number')->nullable();
            $table->float('shipping_price');
            $table->string('shipping_method')->nullable();
            $table->string('shipping_days')->nullable();
            $table->float('coupon_price_discount')->nullable();
            $table->float('coupon_percentage_discount')->nullable();
            $table->float('subtotal');
            $table->float('total');
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();
            $table->json('payment_data')->nullable();
            $table->enum('payment_status', [Order::PAYMENT_STATUS_APPROVED, Order::PAYMENT_STATUS_PENDING, Order::PAYMENT_STATUS_REJECTED])->default(Order::PAYMENT_STATUS_PENDING);
            $table->enum('status', [Order::STATUS_CONFIRMED, Order::STATUS_PROCESSING, Order::STATUS_SENT, Order::STATUS_COMPLETED, Order::STATUS_CANCELED, Order::STATUS_REFUND])->default(Order::STATUS_CONFIRMED);
            $table->string('currency');
            $table->double('currency_value')->nullable()->default(1.0000);
            $table->boolean('send_email')->nullable()->default(false);
            $table->longText('send_email_error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
