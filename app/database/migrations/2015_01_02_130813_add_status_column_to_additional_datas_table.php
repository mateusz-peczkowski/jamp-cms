<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStatusColumnToAdditionalDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('additional_datas', function(Blueprint $table)
		{
			$table->integer('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('additional_datas', function(Blueprint $table)
		{
			$table->dropColumn('status');
		});
	}

}
