<?php

class Backend_NavigationsController extends Backend_BackendController {

	/**
	 * Display a listing of the resource.
	 * GET /navigations
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /navigations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /navigations
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /navigations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$navigations = Navigation::active()->get();
		$navigation = Navigation::active()->find($id);
		// dd(Navigation::$order_column);
		return View::make('backend.navigations.show', compact('navigation', 'navigations'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /navigations/{id}/edit
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
	 * PUT /navigations/{id}
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
	 * DELETE /navigations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	// refresh tree hierarchy
	public function refreshTree($id)
	{
		$tree_structure = json_decode(\Input::get('tree_structure'), true);
		if ($this->refreshTreeHelper($tree_structure))
		{
			return $this->responseOK(false);
		}
		else
		{
			return $this->responseError();
		}

	}

	protected function refreshTreeHelper($tree_structure, $parent_id = null)
	{
		foreach ($tree_structure as $key => $new_node)
		{
			$node = Node::find($new_node['id']);
			$node->order = $key;
			$node->parent_id = $parent_id;
			$node->save();

			if (isset($new_node['children']))
			{
				$this->refreshTreeHelper($new_node['children'], $node->id);
			}
		}
		return true;
	}

}