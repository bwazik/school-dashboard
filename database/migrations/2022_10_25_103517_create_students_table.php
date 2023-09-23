<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('students', function(Blueprint $table) {
			$table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->integer('grade_id')->unsigned();
            $table->integer('classroom_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('gender_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->integer('nationality')->unsigned();
            $table->integer('blood_type')->unsigned();
            $table->date('birthday');
            $table->integer('academic_year');
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
};

