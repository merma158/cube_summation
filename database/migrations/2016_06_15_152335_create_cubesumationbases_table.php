<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCubeSumationBasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cube_sumation_bases', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('iterations_number');
      $table->integer('iteration_to_be_do')->default(0);
      $table->string('status')->default('open');
      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('cube_sumation_bases');
	}

}
