<?php
class Frontend_GenericController extends Frontend_FrontendController {

	public function index()
	{
		$default_view = ($this->page->isHome) ? 'home' : 'generic';
		return $this->view($this->getView($default_view));
	}

	public function jsTranslation()
	{
		$translations = CMS::getAllTranslation();
		$view = View::make('frontend.common.jstranslations', compact('translations'));
		$response = Response::make($view, 200);
		$response->header('Content-Type', 'application/javascript');
		return $response;
	}

}