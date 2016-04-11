<?php
class Frontend_TwittersController extends Frontend_FrontendController {

	public function index()
	{
		// set screen name
		$tweets = json_decode(Twitter::getUserTimeline(array('screen_name' => '', 'count' => 3, 'format' => 'json')));
		return $this->view('twitters.index', compact('tweets'));
	}

	public function show($slug)
	{
	}

}