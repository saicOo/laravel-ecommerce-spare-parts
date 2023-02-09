<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_admin', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_admin');
    }
}
