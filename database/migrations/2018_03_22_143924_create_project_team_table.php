<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTeamTable extends Migration
{
    public function up()
    {
        Schema::create('project_team', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('team_id');
            $table->timestamps();
        });
        Schema::table('project_team', function (Blueprint $table) {
            $table->unique(['project_id', 'team_id',]);
        });
    }
    public function down()
    {
        Schema::dropIfExists('project_team');
    }
}
