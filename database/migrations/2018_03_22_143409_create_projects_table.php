<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->string('token');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index('title');
            $table->unique('token');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
