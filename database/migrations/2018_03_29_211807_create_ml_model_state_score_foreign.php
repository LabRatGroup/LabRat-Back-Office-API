<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelStateScoreForeign extends Migration
{
    public function up()
    {
        Schema::table('ml_model_state_score', function (Blueprint $table) {
            $table->foreign('ml_model_state_id')->references('id')->on('ml_model_states:')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ml_model_state_score', function (Blueprint $table) {
            $table->dropForeign(['ml_model_state_id']);
        });
    }
}
