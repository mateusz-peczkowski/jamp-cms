<?php

class Backend_PressesController extends Backend_BackendController {

	public $model_name = 'Press';

	/**
	 * Display a listing of the resource.
	 * GET /presses
	 *
	 * @return Response
	 */
	public function index()
	{
		$presses = Press::backend()->order()->get();
		return View::make('backend.presses.index', compact('presses'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /presses/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$press = new Press;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.presses.create', compact('press', 'allow_tabs', 'tab'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /presses
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		$input['Press__slug'] = Str::slug($input['Press__title']);
		return Press::modelSave(null, $input);
	}

	/**
	 * Display the specified resource.
	 * GET /presses/{id}
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
		$allow_tabs = array('edit');
		if (!in_array($data['tab'], $allow_tabs)) return false;
		$press = Press::backend()->find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['press'] = $press;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /presses/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.presses.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /presses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		$input['Press__slug'] = Str::slug($input['Press__title']);
		return Press::modelSave($id, $input);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /presses/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}