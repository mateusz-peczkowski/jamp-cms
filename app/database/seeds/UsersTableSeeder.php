<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::create(array(
			'email'	=>	'info@jampstudio.pl',
			'password'	=>	Hash::make('test1234'),
			));
	}

}
