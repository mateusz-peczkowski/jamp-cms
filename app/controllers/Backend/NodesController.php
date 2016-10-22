<?php

class Backend_NodesController extends Backend_BackendController {

	/**
	 * Display a listing of the resource.
	 * GET /nodes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /nodes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$navigation_id = \Input::get('navigation_id');
		$parent_id = \Input::get('parent_id');
		$node = new Node;
		$pages = Page::active()->lists('title', 'id');
		return View::make('backend.nodes.create', compact('pages', 'navigation_id', 'parent_id', 'node'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /nodes
	 *
	 * @return Response
	 */
	public function store()
	{
		$ret = array();
		$page_id = \Input::get('Node__page_id');
		if (!$page_id)
		{
			// create page
			$newPage = Page::createNew();
			$page_id = $newPage['object']->id;
			$ret['redirect'] = action('Backend_PagesController@edit', $page_id);
		}

		$navigation_id = \Input::get('navigation_id');
		$parent_id = \Input::get('parent_id', null) ?: null;
		$last_node = Node::search(array('navigation_id' => $navigation_id, 'parent_id' => $parent_id, 'order' => array('order', 'desc')), 1);
		$order = $last_node ? $last_node->order + 1 : 0;
		$input = array();
		$input['Node__navigation_id'] = $navigation_id;
		$input['Node__parent_id'] = $parent_id;
		$input['Node__page_id'] = $page_id;
		$input['Node__status'] = 1;
		$input['Node__order'] = $order;

		//var_dump($input); exit;
		$newNode = Node::modelSave(null, $input, array('redirect' => false)); 

		$ret = array_merge($newNode, $ret);
		return $ret;
		//var_dump($ret); exit;
		
		
	//	return ($node->save()) ? $this->responseOK() : $this->responseError();
	}

	/**
	 * Display the specified resource.
	 * GET /nodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /nodes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /nodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /nodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// $navigation->refreshTree();
		$node = Node::find($id);
		return ($node->delete()) ? $this->responseOK(trans('backend.deleted')) : $this->responseError();

	}

}