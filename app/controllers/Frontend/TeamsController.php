<?php
class Frontend_TeamsController extends Frontend_FrontendController {

	public function index()
	{
		$teams = Team::active()->order()->get();
		return $this->view('teams.index', compact('teams'));
	}

}