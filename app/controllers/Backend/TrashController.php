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
		$products = Product::where('status','=',2)->get();
		return View::make('backend.trash.index', compact('pages','products'));
	}

}