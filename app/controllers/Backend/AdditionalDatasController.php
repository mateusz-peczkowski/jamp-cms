<?php

class Backend_AdditionalDatasController extends Backend_BackendController {

	// public function create()
	// {
	// 	$data = new AdditionalData;
	// 	return View::make('backend.additional_datas.create', compact('data'));
	// }

	// public function store()
	// {
	// 	//
	// }

	public function edit($id)
	{
		$data = AdditionalData::backend()->find($id);
		return View::make('backend.additional_datas.edit', compact('data'));
	}

	public function update_all()
	{
		$ret = array();
		$model = \Input::get('model');
		$record = \Input::get('record');

		$obj = $model::find($record);

		if ($obj && $obj->connection('Profile'))
		{
			$profile = $obj->connection('Profile')->first();
			$fields = Input::except('model', 'record', 'language');
			foreach ($fields as $field_name => $field_value)
			{
				$additional_data = AdditionalData::search(array('model' => $obj::ModelName(), 'record' => $obj->id, 'name' => $field_name), 1);
				$data = array('value' => $field_value, 'model' => $obj::ModelName(), 'record' => $obj->id, 'name' => $field_name/*, 'status' => 1*/);
				if ($ret = AdditionalData::modelSave($additional_data ? $additional_data->id : null, $data))
				{
					if ($ret['status'] != 'OK')
					{
						return $this->responseError();
					}
				}
			} 
			return $this->responseOK(trans('backend.updated'));
		}
	}


	// public function update($id)
	// {
	// 	$input = \Input::get();
	// 	return AdditionalData::modelSave($id, $input);
	// }

	// public function destroy($id)
	// {
	// 	//
	// }
}