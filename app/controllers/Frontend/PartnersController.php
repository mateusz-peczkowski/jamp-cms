<?php
class Frontend_PartnersController extends Frontend_FrontendController {

	public function index()
	{
		$partners = Partner::active()->order()->get();
		return $this->view('partners.index', compact('partners'));
	}

}