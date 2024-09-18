<?php

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
            $table->integer('admin_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('childcategory_id');
            $table->integer('brand_id');
            $table->integer('pickuppoint_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('sku');
            $table->string('barcode')->nullable();
            $table->string('size')->nullable();
            $table->string('colors')->nullable();
            $table->string('unit')->nullable();
            $table->string('tag')->nullable();
            $table->string('video')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->double('purchase_price',10,2)->nullable();
            $table->double('price',10,2);
            $table->double('discount_price',10,2)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('additional_information')->nullable();
            $table->text('shipping_returns')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->integer('status')->default(0);
            $table->enum('featured',['Yes','No'])->default('No');
            $table->enum('today_deal',['Yes','No'])->default('No');
            $table->enum('trendy',['Yes','No'])->default('No');
            $table->enum('product_slider',['Yes','No'])->default('No');
            $table->integer('product_views')->default(0);
            $table->string('date')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('childcategories')->onDelete('cascade');
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
