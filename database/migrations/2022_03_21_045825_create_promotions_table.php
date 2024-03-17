<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('percentage');
            $table->date('date_start');
            $table->date('date_end');
            $table->enum('type', ['Todos', 'Categoría', 'Marca', 'Producto', 'Curso']);
            $table->enum('conditional', ['Que no sean', 'Que sean', null])->nullable()->default(null);
            $table->boolean('active')->default(true);
            $table->boolean('include_to_variant')->default(false);
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
        Schema::dropIfExists('promotions');
    }
}
