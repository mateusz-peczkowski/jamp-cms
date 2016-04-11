<?php
class Frontend_NewsController extends Frontend_FrontendController {

	public function index()
	{
		$news = News::active()->order()->get();
		return $this->view('news.index', compact('news'));
	}

	public function show($slug)
	{
		$news = News::active()->slug($slug)->first();
		return $this->view('news.show', compact('news'));
	}

}