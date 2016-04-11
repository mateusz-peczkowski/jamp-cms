<?php

class Backend_FormSubmitsController extends \Backend_BackendController {

	public $model_name = 'FormSubmit';

	/**
	 * Display a listing of the resource.
	 * GET /formsubmits
	 *
	 * @return Response
	 */
	public function index($form_id = 'all')
	{
		if ($form_id == 'all')
		{
			$active_form = new Form;
			$submits = FormSubmit::backend()->order()->get();
		}
		else
		{
			$active_form = Form::backend()->find($form_id);
			$submits = $active_form->submits;
		}
		$forms = Form::backend()->get();
		return View::make('backend.form_submits.index', compact('submits', 'forms', 'active_form'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /formsubmits/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /formsubmits
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /formsubmits/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$submit = FormSubmit::backend()->find($id);
		return View::make('backend.form_submits.show', compact('submit'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /formsubmits/{id}/edit
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
	 * PUT /formsubmits/{id}
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
	 * DELETE /formsubmits/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}