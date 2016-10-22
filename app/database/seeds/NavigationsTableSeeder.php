<?php

class NavigationsTableSeeder extends Seeder {

	public function run()
	{
		Navigation::create(array(
			'title'		=>	'Primary',
			'tag'		=>	'primary',
			'status'	=>	1,
			));
	}

}