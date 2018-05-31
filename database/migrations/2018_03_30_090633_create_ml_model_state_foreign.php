<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelStateForeign extends Migration
{
    public function up()
    {
        Schema::table('ml_model_states', function (Blueprint $table) {
            $table->foreign('ml_model_id')->references('id')->on('ml_models')->onDelete('cascade');
            $table->foreign('ml_algorithm_id')->references('id')->on('ml_algorithms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ml_model_states', function (Blueprint $table) {
            $table->dropForeign(['ml_model_id']);
            $table->dropForeign(['ml_algorithm_id']);
        });
    }
}
