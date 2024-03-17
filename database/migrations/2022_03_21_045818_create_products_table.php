<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //Foreign
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('product_brand_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('shipping_class_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');

            //General
            $table->text('name');
            $table->float('price');
            $table->text('slug');
            $table->longText('detail')->nullable();
            $table->longText('description')->nullable();
            $table->text('search_advanced')->nullable();
            $table->string('sku')->index()->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('featured')->nullable()->default(false);
            $table->enum('status', ['Publicado', 'Borrador'])->default('Publicado');
            $table->text('iframe_url')->nullable();
            $table->text('technical_datasheet')->nullable();
            $table->enum('type', [Product::TYPE_PHYSICAL, Product::TYPE_DIGITAL, Product::TYPE_PHYSICAL_AND_DIGITAL])->default(Product::TYPE_PHYSICAL);
            $table->text('file_digital')->nullable();
            $table->boolean('downloadable')->nullable()->default(false);

            //Marketplace
            $table->text('link_amazon')->nullable();
            $table->text('link_mercadolibre')->nullable();

            //Shipping
            $table->float('weight_kl')->nullable();
            $table->float('weight_gr')->nullable();
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->float('length')->nullable();

            //Metatags
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
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
        Schema::dropIfExists('products');
    }
}
