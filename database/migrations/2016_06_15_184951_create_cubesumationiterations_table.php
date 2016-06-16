<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCubeSumationIterationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cube_sumation_iterations', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('n');
      $table->integer('m');
      $table->integer('cube_sumation_base_id')->unsigned();
      $table->foreign('cube_sumation_base_id')->references('id')->on('cube_sumation_bases');
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
		Schema::drop('cube_sumation_iterations');
	}

}
