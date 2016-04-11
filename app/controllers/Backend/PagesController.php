<?php
class Backend_PagesController extends Backend_BackendController {

	public $model_name = 'Page';
	/**
	 * Display a listing of the resource.
	 * GET /pages
	 *
	 * @return Response
	 */


	public function index()
	{
		$pages = Page::backend()->get();
		return View::make('backend.pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pages/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$page = new Page;
		return View::make('backend.pages.create', compact('page'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /pages
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		if (!isset($input['Page__url']) || !$input['Page__url'])
		{
			$title = $input['Page__title'];
			$input['Page__url'] = '/' . \Str::slug($title);
		}
		if ($ret = Page::modelSave(null, $input))
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
	 * GET /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	}

	protected function edit_initialize($id, &$data)
	{
		$allow_tabs = array('edit', 'galleries', 'articles', 'meta', 'advanced');
		// add common tabs 
		$this->addCommonTabs($id, $allow_tabs);

		if (!in_array($data['tab'], $allow_tabs)) return false;
		$page = Page::find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['page'] = $page;

		return true;
	}
	
	/**
	 * Show the form for editing the specified resource.
	 * GET /pages/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.pages.edit', $data);
	}

	public function meta($id)
	{
		$data = array('tab' => 'meta', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.pages.meta', $data);
	}

	public function advanced($id)
	{
		$data = array('tab' => 'advanced');
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.pages.advanced', $data);
	}

	public function galleries($id, $gallery_id = null)
	{
		$data = array('tab' => 'galleries');
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		
		$active_gallery = $data['page']->first_gallery() ?: new Gallery;
		$data['active_gallery'] = $active_gallery;
		return View::make('backend.pages.galleries', $data);
	}

	public function articles($id)
	{
		$data = array('tab' => 'articles');
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		
		return View::make('backend.pages.articles', $data);
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		$ret = $this->commonUpdate($id, $input);
		return array_merge($ret, Page::modelSave($id, $input));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /pages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	// public function check_deactivate($id)
	// {
	// 	$page = Page::backend()->find($id);
	// 	$action = 'deactivate';
	// 	return View::make('backend.pages.nodes', compact('page', 'action'));
	// }

	public function check_delete($id)
	{
		$page = Page::backend()->find($id);
		$action = 'delete';
		return View::make('backend.pages.nodes', compact('page', 'action'));
	}

	protected function delete_page_nodes($id)
	{
		$page = Page::backend()->find($id);
		foreach ($page->nodes as $node)
		{
			$node->delete();
		}
	}

	// public function deactivate($id)
	// {
	// 	$this->delete_page_nodes($id);
	// 	return parent::deactivate($id);
	// }

	public function delete($id)
	{
		$this->delete_page_nodes($id);
		return parent::delete($id);
	}

}