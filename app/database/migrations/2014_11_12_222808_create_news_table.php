<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('intro')->nullable();
			$table->text('description')->nullable();
			$table->string('url');
			$table->string('image')->nullable();
			$table->string('author')->nullable();
			$table->dateTime('published_from')->nullable();
			$table->dateTime('published_to')->nullable();
			$table->integer('status');
			$table->timestamps();
			$table->integer('order')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news');
	}

}
