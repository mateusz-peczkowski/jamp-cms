<?php
class Frontend_PressesController extends Frontend_FrontendController {

	public function index()
	{
		$presses = Press::active()->order()->limit($this->limit)->get();
		return $this->view('presses.index', compact('presses'));
	}

	public function show($slug)
	{
		$press = Press::active()->slug($slug)->first();
		return $this->view('presses.show', compact('press'));
	}

}