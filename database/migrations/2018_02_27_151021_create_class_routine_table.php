<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoutineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_routine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scl_code');
            $table->unsignedInteger('class_id');
            $table->unsignedInteger('time_id');
            $table->unsignedInteger('saturday');
            $table->unsignedInteger('sunday');
            $table->unsignedInteger('monday');
            $table->unsignedInteger('tuesday');
            $table->unsignedInteger('wednesday');
            $table->unsignedInteger('thursday');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_routine');
    }
}
