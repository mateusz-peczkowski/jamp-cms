<?php

class Backend_ConnectionsController extends Backend_BackendController {

	
	public function index()
	{
		//
	}

	
	public function create_connection($model1, $record1, $model2)
	{
		$elements = $model2::active();
		if ($exists = Connection::where('model1', '=', $model1)
    							->where('record1', '=', $record1)
    							->where('model2', '=', $model2)
    							->order()
    							->lists('record2')
    		)
		{
			$elements = $elements->whereNotIn('id', $exists);
		}
		$elements = $elements->lists($model2::$title_column, 'id');
		$element = new $model2;
		return View::make('backend.connections.create', compact('elements', 'element', 'model1', 'record1', 'model2'));
	}

	
	public function store_connection($model1, $record1, $model2)
	{
		$input = \Input::get();
		$record2 = \Input::get('Connection__record2');
		$ret = array();

		if (!$record2)
		{
			// create record2
			$newRecord2 = $model2::createNew();
			$input['Connection__record2'] = $record2 = $newRecord2['object']->id;
			$ret['redirect'] = action('Backend_' . $model2 . 'sController@edit', $record2);
		}
		
		$input['model1'] = $model1;
		$input['record1'] = $record1;
		$input['model2'] = $model2;

		$last = Connection::search(array('model1' => $model1, 'record1' => $record1, 'model2' => $model2, 'order' => array('order', 'desc')), 1);
		$input['Connection__order'] = $last ? $last->order + 1 : 0;
		$newConnection = Connection::modelSave(null, $input, array('redirect' => false));

		$ret = array_merge($newConnection, $ret, array('reload' => true));
		return $ret;
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}

	public function delete_connection($model1, $record1, $model2, $record2)
	{
		if (
			$connection = Connection::where('model1', '=', $model1)
								->where('record1', '=', $record1)
								->where('model2', '=', $model2)
								->where('record2', '=', $record2)
								->first()
			)
		{
			$connection->delete();
		}
		return $this->responseReload();

	}

	public function sortable_connection($model1, $record1, $model2)
	{
		$order = json_decode(\Input::get('ids'));

		$elements = Connection::where('model1', '=', $model1)
								->where('record1', '=', $record1)
								->where('model2', '=', $model2)
								->get();
		foreach ($elements as $element)
		{
			$element->order = array_search($element->record2, $order);
			$element->save();
		}
		return $this->responseOK(false);
	}
}