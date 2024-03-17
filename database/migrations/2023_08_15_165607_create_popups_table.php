<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->boolean('active');
            $table->text('title');
            $table->string('title_color')->nullable()->default('#000');
            $table->text('subtitle');
            $table->string('subtitle_color')->nullable()->default('#000');
            $table->text('description')->nullable();
            $table->string('description_color')->nullable()->default('#000');
            $table->text('btn_url')->nullable();
            $table->text('btn_text')->nullable();
            $table->boolean('newsletter')->nullable();
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
        Schema::dropIfExists('popups');
    }
}
