<?php

class Backend_FormsController extends \Backend_BackendController {

	public $model_name = 'Form';
	/**
	 * Display a listing of the resource.
	 * GET /forms
	 *
	 * @return Response
	 */
	public function index($id = 'all')
	{
		if ($id == 'all')
		{
			if ($first_form = Form::backend()->first())
			{
				// dd(action('Backend_FormsController@index', array(1)));
				return \Redirect::action('Backend_FormsController@index', array($first_form->id));
			}
			else
			{
				return View::make('backend.forms.index');
			}
		}
		else
		{
			$active_form = Form::backend()->find($id);
			$forms = Form::backend()->get();
			return View::make('backend.forms.index', compact('active_form', 'forms'));
		}		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /forms/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = new Form;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.forms.create', compact('form', 'allow_tabs', 'tab'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /forms
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		return Form::modelSave(null, $input);
	}

	/**
	 * Display the specified resource.
	 * GET /forms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function show($id)
	// {
	// 	$active_form = Form::backend()->find($id);
	// 	$forms = Form::backend()->get();

	// 	return View::make('backend.forms.show', compact('active_form', 'forms'));
	// }

	protected function edit_initialize($id, &$data)
	{
		$allow_tabs = array('edit');
		if (!in_array($data['tab'], $allow_tabs)) return false;
		$form = Form::backend()->find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['form'] = $form;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /forms/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.forms.edit', $data);
	}

	// public function controls($id)
	// {
	// 	$data = array('tab' => 'controls');
	// 	if (!$this->edit_initialize($id, $data)) return $this->response404();
	// 	$data['controls'] = FormControl::backend()->form_id($data['form']->id)->order()->get();
		
	// 	return View::make('backend.forms.controls', $data);
	// }

	/**
	 * Update the specified resource in storage.
	 * PUT /forms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		return Form::modelSave($id, $input);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /forms/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}