<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_webs', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('subject');
            $table->text('email');
            $table->text('phone')->nullable();
            $table->text('body');
            $table->enum('conversion', ['No', 'Si', 'En espera'])->default('En espera');
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
        Schema::dropIfExists('email_webs');
    }
}
