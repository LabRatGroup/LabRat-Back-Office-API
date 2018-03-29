<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_model_state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->string('params');
            $table->boolean('is_current')->default(false);
            $table->unsignedInteger('ml_model_id');
            $table->unsignedInteger('ml_algorithm_id');
            $table->unsignedInteger('ml_state_score')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ml_model_state', function (Blueprint $table) {
            $table->index('is_current');
            $table->index('ml_model_id');
            $table->index('ml_algorithm_id');
            $table->unique('token');
            $table->unique('ml_state_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_model_state');
    }
}
