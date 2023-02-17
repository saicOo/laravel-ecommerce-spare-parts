<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('spare parts')->comment('company name');
            $table->string('address')->default('street spare parts')->comment('company address');
            $table->string('phone')->default('01157012640')->comment('company phone');
            $table->integer('tax')->default(14)->comment('tax order');
            $table->integer('shipping')->default(0)->comment('shipping order');
            $table->string('image')->default('default.png')->comment('company image');
            $table->text('payment_url')->nullable();
            $table->text('payment_token')->nullable();
            $table->text('payment_integration_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
