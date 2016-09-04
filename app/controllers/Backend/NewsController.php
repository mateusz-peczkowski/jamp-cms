<?php

class Backend_NewsController extends Backend_BackendController {

	public $model_name = 'News';
	/**
	 * Display a listing of the resource.
	 * GET /news
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = News::backend()->orderBy('order', 'asc')->get();
		return View::make('backend.news.index', compact('news'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /news/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$news = new News;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.news.create', compact('news', 'allow_tabs', 'tab'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /news
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		$input['News__slug'] = Str::slug($input['News__title']);
		$last = News::orderBy('order', 'desc')->first();
		$input['News__order'] = $last ? $last->order + 1 : 0;
		return News::modelSave(null, $input);
	}

	/**
	 * Display the specified resource.
	 * GET /news/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	protected function edit_initialize($id, &$data)
	{
		$allow_tabs = array('edit', 'galleries');
		if (!in_array($data['tab'], $allow_tabs)) return false;
		$news = News::find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['news'] = $news;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /news/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.news.edit', $data);
	}

	public function galleries($id, $gallery_id = null)
	{
		$data = array('tab' => 'galleries');
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		
		$active_gallery = $data['news']->first_gallery() ?: new Gallery;
		$data['active_gallery'] = $active_gallery;
		return View::make('backend.news.galleries', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /news/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		$input['News__slug'] = Str::slug($input['News__title']);
		return News::modelSave($id, $input);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /news/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}