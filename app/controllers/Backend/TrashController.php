<?php

class Backend_TrashController extends Backend_BackendController {

	public $model_name = 'Trash';
	/**
	 * Display a listing of the resource.
	 * GET /trash
	 *
	 * @return Response
	 */
	public function index()
	{
		$status = 2;
		$pages = Page::where('status','=',2)->get();
		$faqs = Faq::where('status','=',2)->get();
		$news = News::where('status','=',2)->get();
		$partners = Partner::where('status','=',2)->get();
		$presses = Press::where('status','=',2)->get();
		$teams = Team::where('status','=',2)->get();
		return View::make('backend.trash.index', compact('pages','faqs','news','partners','presses','teams'));
	}

}