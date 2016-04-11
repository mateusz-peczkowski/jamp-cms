<?php

class Backend_FormControlsController extends \Backend_BackendController {

	public $model_name = 'FormControl';

	public function create($form_id)
	{
		$form = Form::backend()->find($form_id);
		$control = new FormControl;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.form_controls.create', compact('form', 'control', 'allow_tabs', 'tab'));
	}

	public function store($form_id)
	{
		$input = \Input::get();
		$input['form_id'] = $form_id;
		$last = FormControl::search(array('form_id' => $form_id, 'order' => array('order', 'desc')), 1);
		$input['order'] = $last ? $last->order + 1 : 0;
		$ret = FormControl::modelSave(null, $input);
		if ($ret['status'] == 'OK')
		{
			$ret['redirect'] = action('Backend_FormControlsController@edit', array($form_id, $ret['object']->id));
		}
		return $ret;
	}

	protected function edit_initialize($form_id, $id, &$data)
	{
		$allow_tabs = array('edit');
		if (!in_array($data['tab'], $allow_tabs)) return false;
		$control = FormControl::backend()->find($id);
		$form = Form::backend()->find($form_id);
		$data['allow_tabs'] = $allow_tabs;
		$data['form'] = $form;
		$data['control'] = $control;

		return true;
	}

	public function edit($form_id, $id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($form_id, $id, $data)) return $this->response404();
		return View::make('backend.form_controls.edit', $data);
	}

	public function update($form_id, $id)
	{
		$input = \Input::get();
		return FormControl::modelSave($id, $input);
	}
	
	public function destroy($id)
	{
		//
	}

	// public function activate($form_id, $id)
	// {
	// 	return $this->change_status($id, 1);
	// }

	// public function deactivate($form_id, $id)
	// {
	// 	return $this->change_status($id, 0);
	// }

	// public function delete($form_id, $id)
	// {
	// 	return $this->change_status($id, 2);
	// }

}