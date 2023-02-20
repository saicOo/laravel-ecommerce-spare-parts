<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->float('total_price', 8, 2)->nullable();
            $table->float('sub_total', 8, 2)->nullable();
            $table->float('tax')->nullable();
            $table->float('shipping')->nullable();
            $table->boolean('payment_status')->default(2)->comment('1=>paid ,2=>waiting ,3=>unpaid');
            $table->boolean('payment_method')->default(0)->comment('0=>cash ,1=>online');
            $table->smallInteger('tracking')->default(1)->comment('1=>Ordered ,2=>Pending ,3=>Accept ,4=>Delivery ,5=>Received');
            $table->string('building')->nullable();
            $table->string('apartment')->nullable();
            $table->string('floor')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
