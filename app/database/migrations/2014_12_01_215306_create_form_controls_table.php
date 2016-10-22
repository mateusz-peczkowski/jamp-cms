<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormControlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_controls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_id')->unsigned();
			$table->foreign('form_id')->references('id')->on('forms');
			$table->string('name');
			$table->string('label');
			$table->string('type');
			$table->string('default');
			$table->string('values');
			$table->string('rules');
			$table->integer('status');
			$table->integer('order');
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
		Schema::drop('form_controls');
	}

}
