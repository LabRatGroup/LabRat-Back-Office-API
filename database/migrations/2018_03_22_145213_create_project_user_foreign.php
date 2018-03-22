<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUserForeign extends Migration
{
    public function up()
    {
        Schema::table('project_user', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('project_user', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
        });
    }
}
