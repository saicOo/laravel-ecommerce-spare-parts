<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->string('invoice_no',50)->unique();
            $table->double('total_price', 8, 2)->nullable();
            $table->double('amount_paid', 8, 2)->nullable()->default(0);
            $table->boolean('payment_type')->default(1)->comment('1=>new ,2=>return');
            $table->boolean('payment_status')->default(1)->comment('1=>cash ,2=>defrred,3=>return');
            $table->boolean('active')->default(0)->comment('0=>not active ,1=>active');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
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
        Schema::dropIfExists('purchases');
    }
}
