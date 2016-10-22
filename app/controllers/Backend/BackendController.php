<?php

class Backend_BackendController extends \BaseController {

	function __construct()
	{
		// site languages
		$languages = Language::backend()->lists('title');
		View::share('languages', $languages);

		// active language edit defaultLocale
		$active_language = Language::activeLanguage();
		View::share('active_language', $active_language);
		\Config::set('backend.active_language', $active_language);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function responseOK($message = null)
	{
		$message = $message ?: 'Zapisane';
		return $this->response('OK', $message);
	}

	protected function responseError()
	{
		return $this->response('Error', 'Error message');
	}

	protected function response($status, $message)
	{
		$ret = array();
		$ret['status'] = $status;
		if (!is_null($message))
		{
			$ret['message'] = $message;
		}
		return \Response::json($ret);
	}

	protected function responseReload()
	{
		$response = array(
			'status' => 'OK',
			'reload' =>	true,
			);

		return Response::json($response);
	}

	// work?
	protected function response404()
	{
		return App::abort(404);
	}

	protected function getIdObjects($array)
	{
		$ret = array();
		foreach ($array as $object)
		{
			$ret[] = $object->id;
		}
		return $ret;
	}

	// common actions

	// sortable elements
	public function sortable()
	{
		$order = json_decode(\Input::get('ids'));
		// var_dump($order); exit;

		$model = $this->model_name;
		$elements = $model::backend()->get();

		foreach ($elements as $element)
		{
			$element->order = array_search($element->id, $order);
			$element->save();
		}
		return $this->responseOK(false);
	}

	// change element status
	public function activate($id)
	{
		return $this->change_status($id, 1);
	}

	public function deactivate($id)
	{
		return $this->change_status($id, 0);
	}

	public function destroyever($id)
	{
		return $this->change_status($id, 3);
	}

	public function delete($id)
	{
		return $this->change_status($id, 2);
	}

	public function change_status($id, $status)
	{
		$model = $this->model_name;
		$ret = $model::modelSave($id, array('status' => $status));
		$ret['redirect'] = URL::previous();
		return $ret;
	}

	public function additional_data($id)
	{
		$data = array('tab' => 'additional_data', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();

		return View::make('backend.' . $this->viewFromModel() . '.additional_data', $data);
	}

	// helpers
	protected function addCommonTabs($id, &$tabs)
	{
		// additional data
		$model_name = $this->model_name;
		if ($element = $model_name::backend()->find($id))
		{
			if ($profile = $element->connection('Profile', 1, 1))
			{
				if ($profile->def('additional_data'))
				{
					$tabs[] = 'additional_data';
				}
			}
		}
	}

	protected function commonUpdate($id, $input)
	{
		// profile
		$ret = array();

		$model = $this->model_name;
		$element = $model::backend()->find($id);

		if (isset($input['Profile__id']))
		{
			$this->updateProfile($element, $input, $ret);
		}
		return $ret;

	}

	/*
	start profile update functions
	*/
	protected function updateProfile($element, $input, &$ret)
	{
		$profile = Profile::active()->find($input['Profile__id']);

		if ($this->isProfileChanged($profile, $element))
		{
			// TODO: update instead delete, create
			Connection::detach_all(array('model1' => $this->model_name, 'record1' => $element->id, 'model2' => 'Profile'));

			if ($input['Profile__id'])
			{
				Connection::modelSave(null, array('model1' => $this->model_name, 'record1' => $element->id, 'model2' => 'Profile', 'record2' => $input['Profile__id'], 'order' => 0));			
				
				foreach ($profile->fields() as $field => $value)
				{
					if (in_array($field, $element::$map))
					{
						$element->$field = $value;
					}
				}
				$element->save();
			}
			$ret['reload'] = \URL::previous();
		}
	}

	protected function isProfileChanged($profile, $element)
	{
		$newProfileID = $profile ? $profile->id : null;
		$lastProfileID = $element->profile() ? $element->profile()->id : null;

		return !($newProfileID == $lastProfileID);
	}
	/*
	end profile update functions
	*/


	protected function viewFromModel()
	{
		return Str::plural(Str::slug($this->model_name));
	}
}
