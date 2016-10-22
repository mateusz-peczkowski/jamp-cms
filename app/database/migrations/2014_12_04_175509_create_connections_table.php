<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConnectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('connections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('model1');
			$table->integer('record1')->unsigned();
			$table->string('model2');
			$table->integer('record2')->unsigned();
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
		Schema::drop('connections');
	}

}
