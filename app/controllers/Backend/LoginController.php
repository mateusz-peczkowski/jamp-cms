<?php

class Backend_LoginController extends \BaseController {

	public function index()
	{
		// var_dump(Hash::make('test1234')); exit;
		if (Auth::check())
		{
			$navigation = Navigation::active()->first();
        	return Redirect::action('Backend_NavigationsController@show', array($navigation->id));
		}
		return View::make('backend.login');
	}

	public function login()
	{
		$userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
        /* Try to authenticate the credentials */
        if(Auth::attempt($userdata)) 
        {
            // we are now logged in, go to cmsbackend
            return Redirect::to('cmsbackend');
        }
        else
        {
            return Redirect::to('cmsbackend');
        }
	}

	public function logout()
	{
		Auth::logout();
        return Redirect::to('cmsbackend');

	}

}
