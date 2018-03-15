<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->unique(['user_id', 'role_id',]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
