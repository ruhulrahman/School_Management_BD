<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsRegTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools_reg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scl_name');
            $table->string('scl_code');
            $table->string('scl_email');
            $table->string('scl_phone');
            $table->string('scl_establish_date');
            $table->string('thana_id');
            $table->string('scl_address');
            $table->string('scl_expire_date')->nullable();
            $table->string('scl_password');
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('schools_reg');
    }
}
