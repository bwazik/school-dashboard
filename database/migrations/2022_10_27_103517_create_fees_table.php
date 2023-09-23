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
		Schema::create('fees', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->decimal('amount');
            $table->integer('grade_id')->unsigned();
            $table->integer('classroom_id')->unsigned();
			$table->string('note')->nullable();
            $table->integer('year');
            $table->integer('type');
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
        Schema::dropIfExists('fees');
    }
};

