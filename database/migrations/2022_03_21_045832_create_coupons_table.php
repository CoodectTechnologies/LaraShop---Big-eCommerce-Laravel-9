
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index()->unique();
            $table->integer('percentage');
            $table->date('date_end');
            $table->float('minimum_expense')->nullable(); //De ser nulo no implica un minimo de gasto
            $table->boolean('exclude_promotion')->default(true);
            $table->integer('limit_of_use')->nullable(); //De ser nulo, no tendra limite
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('coupons');
    }
}
