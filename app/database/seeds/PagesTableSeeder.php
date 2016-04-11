<?php

class PagesTableSeeder extends Seeder {

	public function run()
	{
		// home page
		Page::create(array(
			'title'		=>	'Home',
			'tag'		=>	'homePage',
			'status'	=>	1,
			'url'	=>	'/',
			));
	}

}