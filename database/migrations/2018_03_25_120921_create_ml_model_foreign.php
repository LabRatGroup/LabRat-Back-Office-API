<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelForeign extends Migration
{
    public function up()
    {
        Schema::table('ml_model', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ml_model', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
        });
    }
}
