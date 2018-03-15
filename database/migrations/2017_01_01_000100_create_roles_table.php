<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('alias');
            $table->string('role_type')->nullable();
            $table->boolean('root')->default(false);
            $table->text('permissions')->nullable();
            $table->unsignedInteger('security_clearance')->nullable();
            $table->timestamps();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->unique('alias');
            $table->index('security_clearance');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
