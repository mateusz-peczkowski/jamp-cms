<?php

use Neo\WpApi\WpApi;
use Neo\WpApi\Service\GuzzleService;

class Frontend_WordPressController extends Frontend_FrontendController {

	public function index()
	{
		// Get the instance of the WP Api
		$wp = new WpApi(new GuzzleService);

		// Set the configuration
		$config = array(
		    'client_id'     => '',
		    'client_secret' => '',
		    'username'      => '',
		    'password'      => '',
		    'site_id'       => '',
		);

		// Connect to the API
		$wp = $wp->setConfig($config)->connect();

		$query = $wp->api('GET', 'sites/' . $config['site_id'] . '/posts/?number=3');

		$posts = array();
		if ($query->lastApiResult)
		{
			$posts = json_decode($query->lastApiResult)->posts;
		}
		return $this->view('wordpress.index', compact('posts'));
	}

}