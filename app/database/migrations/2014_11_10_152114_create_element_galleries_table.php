<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElementGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('element_galleries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('model');
			$table->integer('model_id')->unsigned();
			$table->integer('gallery_id')->unsigned();
			$table->foreign('gallery_id')->references('id')->on('galleries');
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
		Schema::drop('element_galleries');
	}

}
