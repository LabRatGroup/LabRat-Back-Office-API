<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelPredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_model_predictions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->mediumText('description')->nullable();
            $table->string('token');
            $table->string('code')->nullable(true);
            $table->unsignedInteger('ml_model_id')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_model_predictions');
    }
}
