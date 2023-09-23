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
		Schema::create('sections', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->boolean('status')->default(0);
			$table->integer('grade_id')->unsigned();
			$table->integer('classroom_id')->unsigned();
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
        Schema::dropIfExists('sections');
    }
};

