<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('navigation_id')->unsigned();
			$table->foreign('navigation_id')->references('id')->on('navigations');
			$table->integer('page_id')->unsigned();
			$table->foreign('page_id')->references('id')->on('pages');
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('order')->unsigned()->nullable();
			$table->integer('status');
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
		Schema::drop('nodes');
	}

}
