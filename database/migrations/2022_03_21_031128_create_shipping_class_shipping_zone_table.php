<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingClassShippingZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_class_shipping_zone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipping_class_id')->constrained();
            $table->foreignId('shipping_zone_id')->constrained();
            $table->float('price');
            $table->integer('multiply_quantity')->nullable()->default(null);
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
        Schema::dropIfExists('shipping_class_shipping_zone');
    }
}
