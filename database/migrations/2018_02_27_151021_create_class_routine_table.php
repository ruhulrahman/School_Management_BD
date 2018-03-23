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
            $table->integer('school_id');
            $table->string('class_id');
            $table->string('day_id');
            $table->string('subject_id');
            $table->string('class_time');
            $table->string('teacher_id');
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
