<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlAlgorithmParams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_algorithm_params', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->longText('description')->nullable(true);
            $table->string('key')->nullable(false);
            $table->float('low_range')->nullable(true);
            $table->float('high_range')->nullable(true);
            $table->float('step')->nullable(true);
            $table->string('classType')->nullable(false);
            $table->float('options')->nullable(true);
            $table->unsignedInteger('ml_algorithm_id')->nullable(true);
            $table->timestamps();
        });

        Schema::table('ml_algorithm_params', function (Blueprint $table) {
            $table->index('key');
            $table->index('name');
            $table->index('ml_algorithm_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ml_algorithm_params');
    }
}
