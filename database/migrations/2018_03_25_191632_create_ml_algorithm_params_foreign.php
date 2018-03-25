<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlAlgorithmParamsForeign extends Migration
{
    public function up()
    {
        Schema::table('ml_algorithm_params', function (Blueprint $table) {
            $table->foreign('ml_algorithm_id')->references('id')->on('ml_algorithms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ml_algorithm_params', function (Blueprint $table) {
            $table->dropForeign(['ml_algorithm_id']);
        });
    }
}
