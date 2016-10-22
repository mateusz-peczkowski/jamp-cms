<?php

class Backend_ArticlesController extends Backend_BackendController {

	public $model_name = 'Article';
	/**
	 * Display a listing of the resource.
	 * GET /articles
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::backend()->get();
		return View::make('backend.articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /articles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$article = new Article;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.articles.create', compact('article', 'allow_tabs', 'tab'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /articles
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		if ($ret = Article::modelSave(null, $input))
		{
			if (isset($ret['object']))
			{
				$this->commonUpdate($ret['object']->id, $input);
			}
		}
		return $ret;
	}

	/**
	 * Display the specified resource.
	 * GET /articles/{id}
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
		// add common tabs 
		$this->addCommonTabs($id, $allow_tabs);

		if (!in_array($data['tab'], $allow_tabs)) return false;
		$article = Article::backend()->find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['article'] = $article;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /articles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.articles.edit', $data);
	}

	public function galleries($id, $gallery_id = null)
	{
		$data = array('tab' => 'galleries');
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		
		$active_gallery = $data['article']->first_gallery() ?: new Gallery;
		$data['active_gallery'] = $active_gallery;
		return View::make('backend.articles.galleries', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		$ret = $this->commonUpdate($id, $input);
		return array_merge($ret, Article::modelSave($id, $input));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}