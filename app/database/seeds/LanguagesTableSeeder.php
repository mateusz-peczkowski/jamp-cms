<?php

class LanguagesTableSeeder extends Seeder {

	public function run()
	{
		// pl
		Language::create(array(
			'title'		=>	'pl',
			'is_default'=>	1,
			'order'		=>	0,
			'status'	=>	1,
			));

		// en
		Language::create(array(
			'title'		=>	'en',
			'is_default'=>	0,
			'order'		=>	1,
			'status'	=>	0,
			));
	}

}