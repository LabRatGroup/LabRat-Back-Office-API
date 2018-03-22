<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUserTable extends Migration
{
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('validation_token')->nullable(true);
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->boolean('is_valid')->default(false);
            $table->boolean('is_owner')->default(false);
            $table->timestamps();
        });
        Schema::table('project_user', function (Blueprint $table) {
            $table->index('is_owner');
            $table->index('is_valid');
            $table->unique(['validation_token']);
            $table->unique(['user_id', 'project_id',]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_user');
    }
}
