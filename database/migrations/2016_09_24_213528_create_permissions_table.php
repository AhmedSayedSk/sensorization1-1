<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{

    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('concessionaire_id');
            $table->integer('role_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('permissions');
    }
}
