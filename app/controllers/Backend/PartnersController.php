<?php

class Backend_PartnersController extends Backend_BackendController {

	public $model_name = 'Partner';
	/**
	 * Display a listing of the resource.
	 * GET /partners
	 *
	 * @return Response
	 */
	public function index()
	{
		$partners = Partner::backend()->order()->get();
		return View::make('backend.partners.index', compact('partners'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /partners/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$partner = new Partner;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.partners.create', compact('partner', 'allow_tabs', 'tab'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /partners
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		$last = Partner::search(array('order' => array('order', 'desc')), 1);
		$input['order'] = $last ? $last->order + 1 : 0;
		return Partner::modelSave(null, $input);
	}

	/**
	 * Display the specified resource.
	 * GET /partners/{id}
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
		$partner = Partner::backend()->find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['partner'] = $partner;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /partners/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.partners.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /partners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		return Partner::modelSave($id, $input);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /partners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}