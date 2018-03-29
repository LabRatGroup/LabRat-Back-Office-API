<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelStateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_model_state_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->unsignedInteger('ml_model_state_id')->nullable(true);
            $table->string('params');
            $table->string('kappa');
            $table->string('accuracy');
            $table->string('tp');
            $table->string('tn');
            $table->string('fp');
            $table->string('fn');
            $table->string('sensitivity');
            $table->string('specificity');
            $table->string('precision');
            $table->string('recall');
            $table->string('auc');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ml_model_state_scores', function (Blueprint $table) {
            $table->index('kappa');
            $table->index('accuracy');
            $table->unique('ml_model_state_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_model_state_scores');
    }
}
