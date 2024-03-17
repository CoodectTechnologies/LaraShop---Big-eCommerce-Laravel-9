<?php

use App\Models\ConfiguratorStage;
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
        Schema::create('configurator_stages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('order');
            $table->boolean('optional')->default(false);
            $table->enum('type', [ConfiguratorStage::TYPE_COMPONENT, ConfiguratorStage::TYPE_ADDON]);
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
        Schema::dropIfExists('configurator_stages');
    }
};
