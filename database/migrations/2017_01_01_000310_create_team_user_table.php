<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTeamUserTable extends Migration
{
    public function up()
    {
        Schema::create('team_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('validation_token')->nullable();
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->boolean('is_owner')->default(false);
            $table->boolean('is_valid')->default(false);
            $table->timestamps();
        });

        Schema::table('team_user', function (Blueprint $table) {
            $table->index('is_owner');
            $table->index('is_valid');
            $table->unique('validation_token');
            $table->unique(['user_id', 'item_id',]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_user');
    }
}
