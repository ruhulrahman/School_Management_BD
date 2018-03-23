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
            $table->integer('school_id');
            $table->string('name');
            $table->string('phone', 20)->unique();
            $table->string('email', 191)->unique();
            $table->string('password');
            $table->string('slug');
            $table->string('pic');
            $table->string('user_type');
            $table->string('rank')->nullable();
            $table->string('power')->nullable();
            $table->string('gender');
            $table->string('date_of_birth');
            $table->integer('thana_id');
            $table->integer('address');
            $table->string('religion');
            $table->boolean('status')->default('1');
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
