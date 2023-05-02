<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('email',50)->unique();
            $table->string('password',255);
            $table->string('city',50)->nullable();
            $table->string('governorate',50)->nullable();
            $table->string('street',50)->nullable();
            $table->string('building',50)->nullable();
            $table->string('apartment',50)->nullable();
            $table->string('floor',50)->nullable();
            $table->string('phone',15)->nullable();
            $table->integer('payment_callback')->nullable();
            $table->timestamps();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
