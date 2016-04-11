<?php

class Frontend_FrontendController extends \BaseController {

	protected $allow_params = array('page', 'news', 'view', 'data', 'limit');

	protected $page;
	protected $news;
	protected $view;
	protected $data;
	protected $limit;

	protected $languagePrefix;

	// CMS::render 3 param
	// protected $config;

	function __construct($config = array())
	{
		$this->setConfigs($config);
		$this->setLanguagePrefix();	
	}

	private function setConfigs($config)
	{
		foreach ($config as $name => $value)
		{
			$this->setConfigIfAllow($name, $value);
		}
	}

	private function setConfigIfAllow($name, $value)
	{
		if (in_array($name, $this->allow_params))
		{
			$this->setData($name, $value);
		}
	}

	private function setData($name, $value)
	{
		$this->$name = $value;
		View::share('global_' . $name, $value);
		\Config::set('app.global_' . $name, $value);
	}

	private function setLanguagePrefix()
	{
		$languagePrefix = '';
		if (Language::activeLanguage() != Language::defaultLanguage())
		{
			$languagePrefix = '/' . Language::activeLanguage();
		}
		$this->setData('languagePrefix', $languagePrefix);
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

	protected function view($view_default, $data = array())
	{
		$view_name = $this->getView($view_default);
		return View::make('frontend.' . $view_name, $data);
	}

	protected function getView($view_default)
	{
		if ($this->view) return $this->view;
		if ($this->page && $this->page->view) return $this->page->view;
		return $view_default;
	}

}
