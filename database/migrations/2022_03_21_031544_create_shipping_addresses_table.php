<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null');
            $table->text('municipality');
            $table->text('colony');
            $table->text('zip_code');
            $table->text('street');
            $table->text('street_number_int')->nullable();
            $table->text('street_number_ext');
            $table->text('street_between')->nullable();
            $table->text('street_references')->nullable();
            $table->text('company')->nullable();
            $table->text('name');
            $table->text('phone');
            $table->text('email');
            $table->double('default')->nullable()->default(false);
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
        Schema::dropIfExists('shipping_addresses');
    }
}
