<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserForeign extends Migration
{
    public function up()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
        });
    }
}
