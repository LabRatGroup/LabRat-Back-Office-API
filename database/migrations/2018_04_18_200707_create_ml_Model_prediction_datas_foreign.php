<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelPredictionDatasForeign extends Migration
{
    public function up()
    {
        Schema::table('ml_model_prediction_datas', function (Blueprint $table) {
            $table->foreign('ml_model_prediction_id')->references('id')->on('ml_model_predictions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ml_model_prediction_datas', function (Blueprint $table) {
            $table->dropForeign(['ml_model_prediction_id']);
        });
    }
}
