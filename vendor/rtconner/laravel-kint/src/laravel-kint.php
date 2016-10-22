<?php

// $configs = config('kint');

// print_r($configs);

// include_once(base_path('vendor/raveren/kint/Kint.class.php'));

if(!defined('ddd')) {
	function ddd()
	{
		if ( !Kint::enabled() ) return;
	
		$args = func_get_args();
		call_user_func_array( array( 'Kint', 'dump' ), $args );
		die;
	}
}