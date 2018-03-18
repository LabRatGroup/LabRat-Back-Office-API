<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{

    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('token');
            $table->timestamps();
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->unique('token');
            $table->index('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
