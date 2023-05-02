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
            $table->string('name_en',50);
            $table->string('name_ar',50);
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('country',50);
            $table->float('purchase_price', 8, 2);
            $table->float('price', 8, 2);
            $table->integer('stock');
            // $table->year('start_year')->nullable();
            // $table->year('end_year')->nullable();
            $table->text('images')->default('["default.png"]');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars');
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
