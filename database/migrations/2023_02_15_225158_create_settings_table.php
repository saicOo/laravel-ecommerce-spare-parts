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
            $table->text('payment_url')->default('https://accept.paymob.com/api/');
            $table->text('payment_token')->default('ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2libUZ0WlNJNkltbHVhWFJwWVd3aUxDSndjbTltYVd4bFgzQnJJam8yTkRjME56WjkuTVp6N2llOEM2S3k5RHVCQTV2NzdTQ2J3REVNcFRmdjBROFFaaDBxWUxqX21FLWFiX2hCQ0NWa1ExZ2U5Y3hwQjJxWUluVWs4b19Vd1BNVzlPY0tUWEE=');
            $table->text('payment_integration_id')->default('3160861');
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
