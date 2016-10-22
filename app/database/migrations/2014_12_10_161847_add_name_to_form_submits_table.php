<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNameToFormSubmitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('form_submits', function(Blueprint $table)
		{
			$table->string('name')->nullable();
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->text('message')->nullable();
			$table->string('email')->nullable();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('form_submits', function(Blueprint $table)
		{
			$table->dropColumn('name');
			$table->dropColumn('firstname');
			$table->dropColumn('lastname');
			$table->dropColumn('message');
			$table->dropColumn('email');
		});
	}

}
