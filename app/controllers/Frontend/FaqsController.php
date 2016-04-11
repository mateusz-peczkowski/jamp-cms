<?php
class Frontend_FaqsController extends Frontend_FrontendController {

	public function index()
	{
		$faqs = Faq::active()->order()->get();
		return $this->view('faqs.index', compact('faqs'));
	}
}