<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLinkToGalleryMediasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gallery_medias', function(Blueprint $table)
		{
			$table->string('link')->nullable();
			$table->string('link_title')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gallery_medias', function(Blueprint $table)
		{
			$table->dropColumn('link');
			$table->dropColumn('link_title');
		});
	}

}
