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
        Schema::create('configurator_budget_configurator_performance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('configurator_budget_id')->nullable();
            $table->foreign('configurator_budget_id', 'configurator_budget_pivot_performance_id')->references('id')->on('configurator_budgets')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('configurator_performance_id')->nullable();
            $table->foreign('configurator_performance_id', 'configurator_performance_pivot_budget_id')->references('id')->on('configurator_performances')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('configurator_budget_configurator_performance');
    }
};
