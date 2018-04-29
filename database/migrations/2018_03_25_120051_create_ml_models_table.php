<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->string('positive')->nullable(false);
            $table->string('description')->nullable();
            $table->string('token');
            $table->unsignedInteger('project_id')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ml_models', function (Blueprint $table) {
            $table->unique('token');
            $table->index('project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_model');
    }
}
