<?php

class Backend_DefaultsController  extends Backend_BackendController {

	protected $allow_tabs = array('meta');

	public function index()
	{
		return \Redirect::action('Backend_DefaultsController@' . $this->allow_tabs[0]);
	}

	public function update($tab)
	{
		$fname = 'update_' . $tab;
		return $this->$fname();
	}

	protected function initialize($tab)
	{
		View::share('allow_tabs', $this->allow_tabs);
		View::share('tab', $tab);
	}

	public function meta()
	{
		$this->initialize('meta');
		$page = Page::byTag('default');
		if (!$page) $page = new Page;

		return View::make('backend.defaults.meta', compact('page'));
	}

	public function update_meta()
	{
		$page = Page::byTag('default');
		if (!$page) $page = new Page;

		$ret = Page::modelSave($page->id, \Input::get(), array('redirect' => false));
		return array(
			'status' => 'OK',
			'message' => trans('backend.update'),
			'action' => 'UPDATE',
			);
	}


} 