<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelStateTrainingDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_model_state_training_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token');
            $table->string('params')->nullable(false);
            $table->string('mime_type')->nullable(false);
            $table->string('file_path')->nullable(false);
            $table->unsignedInteger('ml_model_state_id')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ml_model_state_training_datas', function (Blueprint $table) {
            $table->index('ml_model_state_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_model_state_training_datas');
    }
}
