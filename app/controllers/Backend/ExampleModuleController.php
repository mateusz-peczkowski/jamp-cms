<?php

class Backend_ExampleModuleController extends Backend_BackendController {

	// define in controller
	//public $model_name;

	public $view_dir = '';

	public function __construct()
	{
		parent::__construct();

		View::share('model_name', $this->model_name);
		$this->view_dir = Str::plural(Str::slug($this->model_name));
		View::share('view_dir', $this->view_dir);
	}

	public function index()
	{
		$model_name = $this->model_name;
		$elements = $model_name::backend()->order()->get();
		return View::make('backend.' . $this->view_dir . '.index', compact('elements'));
	}

	public function create()
	{
		$model_name = $this->model_name;
		$element = new $model_name;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.' . $this->view_dir . '.create', compact('element', 'allow_tabs', 'tab'));
	}

	public function store()
	{
		$model_name = $this->model_name;
		$input = \Input::get();
		if ($model_name::$has_slug)
		{
			$input[$model_name . '__slug'] = Str::slug($input[$model_name . '__title']);
		}

		if ($ret = $model_name::modelSave(null, $input))
		{
			if (isset($ret['object']))
			{
				$this->commonUpdate($ret['object']->id, $input);
			}
		}

		return $ret;
	}

	protected function edit_initialize($id, &$data)
	{
		$model_name = $this->model_name;
		$allow_tabs = array('edit'/*, 'galleries'*/);
		if (!in_array($data['tab'], $allow_tabs)) return false;
		$element = $model_name::find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['element'] = $element;

		return true;
	}

	public function edit($id)
	{
		$model_name = $this->model_name;
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.' . $this->view_dir . '.edit', $data);
	}

	// public function galleries($id, $gallery_id = null)
	// {
	// 	$data = array('tab' => 'galleries');
	// 	if (!$this->edit_initialize($id, $data)) return $this->response404();
		
	// 	$active_gallery = $data['news']->first_gallery() ?: new Gallery;
	// 	$data['active_gallery'] = $active_gallery;
	// 	return View::make('backend' . $this->view_dir . 'galleries', $data);
	// }

	public function update($id)
	{
		$model_name = $this->model_name;
		$input = \Input::get();
		if ($model_name::$has_slug)
		{
			$input[$model_name . '__slug'] = Str::slug($input[$model_name . '__title']);
		}
		$this->commonUpdate($id, $input);
		return $model_name::modelSave($id, $input);
	}

}