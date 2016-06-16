<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCubeSumationCommandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cube_sumation_commands', function(Blueprint $table) {
      $table->increments('id');
      $table->string('command');
      $table->text('params');
      $table->integer('cube_sumation_iteration_id')->unsigned();
      $table->foreign('cube_sumation_iteration_id')->references('id')->on('cube_sumation_iterations');
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
		Schema::drop('cube_sumation_commands');
	}

}
