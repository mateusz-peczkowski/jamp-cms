<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMetaToPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pages', function(Blueprint $table)
		{
			$table->text('meta_title')->nullable();
			$table->text('meta_description')->nullable();
			$table->text('meta_robots')->nullable();
			$table->text('meta_head')->nullable();
			$table->text('meta_footer')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pages', function(Blueprint $table)
		{
			$table->dropColumn('meta_title');
			$table->dropColumn('meta_description');
			$table->dropColumn('meta_robots');
			$table->dropColumn('meta_head');
			$table->dropColumn('meta_footer');
		});
	}

}
