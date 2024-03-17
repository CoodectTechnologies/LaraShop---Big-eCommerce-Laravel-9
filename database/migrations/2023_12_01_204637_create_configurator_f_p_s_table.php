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
        Schema::create('configurator_f_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('configurator_game_id')->constrained()->onDelete('cascade');
            $table->foreignId('configurator_performance_id')->constrained()->onDelete('cascade');
            $table->foreignId('configurator_budget_id')->constrained()->onDelete('cascade');
            $table->foreignId('configurator_chipset_id')->constrained()->onDelete('cascade');
            $table->string('fps');
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
        Schema::dropIfExists('configurator_f_p_s');
    }
};
