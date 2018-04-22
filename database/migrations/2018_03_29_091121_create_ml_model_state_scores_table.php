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
            $table->string('params')->nullable(false);
            $table->float('kappa')->nullable(false);
            $table->float('accuracy')->nullable(false);
            $table->string('confusion_matrix')->nullable(false);
            $table->float('sensitivity')->nullable(false);
            $table->float('specificity')->nullable(false);
            $table->float('precision')->nullable(false);
            $table->float('recall')->nullable(false);
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
