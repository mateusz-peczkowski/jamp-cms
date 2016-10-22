<?php
class Frontend_FaqCategoriesController extends Frontend_FrontendController {

	public function index()
	{
		$categories = FaqCategory::active()->order()->get();
		return $this->view('faq_categories.index', compact('categories'));
	}
}