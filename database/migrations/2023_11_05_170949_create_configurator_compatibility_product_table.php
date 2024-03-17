<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurator_compatibility_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('configurator_compatibility_id'); $table->foreign('configurator_compatibility_id', 'configurator_compatibility_id')->references('id')->on('configurator_stage_product')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id', 'product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('configurator_compatibility_product');
    }
};
