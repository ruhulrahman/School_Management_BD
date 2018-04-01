<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 191)->unique();
            $table->string('phone', 20)->unique();            
            $table->string('scl_code');
            $table->integer('class_id')->nullable();
            $table->string('password');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('religion');
            $table->integer('thana_id')->unsigned();
            $table->string('address');
            $table->string('slug');
            $table->string('pic');
            $table->string('user_type');
            $table->string('rank')->nullable();
            $table->string('power')->nullable();
            $table->integer('status')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
