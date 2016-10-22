<?php

class Backend
{
	public static function Breadcrumb()
	{
		$breadcrumb = array(
			array(
				'name' => '<i class="fa fa-home"></i>',
				'url'	=>	'/cmsbackend',
				),
			);
		$nodes = self::Subnodes(null, true);

		foreach ($nodes as $node)
		{
			if (self::IsActivePage($node))
			{
				$breadcrumb[] = array(
					'name'	=>	$node['name'],
					'url'	=>	self::GetMenuLink($node),
				);

				foreach (self::SubNodes($node, true) as $subnode)
				{
					if (self::IsActivePage($subnode))
					{
						$breadcrumb[] = array(
							'name'	=>	$subnode['name'],
							'url'	=>	self::GetMenuLink($subnode),
							);	
							foreach (self::SubNodes($subnode, true) as $subsubnode)
							{
								if (self::IsActivePage($subsubnode))
								{
									$breadcrumb[] = array(
										'name'	=>	$subsubnode['name'],
										'url'	=>	self::GetMenuLink($subsubnode),
										);
										foreach (self::SubNodes($subsubnode, true) as $subsubsubnode)
										{
											if (self::IsActivePage($subsubsubnode))
											{
												$breadcrumb[] = array(
													'name'	=>	$subsubsubnode['name'],
													'url'	=>	'#',
													);					
											}
										}					
								}
							}				
					}
				}
			}
		}
		
		// 	array(
		// 		'title' => 'Pages',
		// 		'url'	=>	'/cmsbackend/pages',
		// 		),
		// 	array(
		// 		'title' => 'Edit',
		// 		'url'	=>	'/cmsbackend/pages/edit',
		// 		),
		// 	);
		return $breadcrumb;
	}


	public static function GetControllerAction($action = null)
	{
		if (is_null($action))
		{
			return Route::currentRouteAction();
		}
		else
		{
			return preg_replace('|@.*|', '@' . $action, Route::currentRouteAction());
		}
	}

	public static function GetMenuLink($array)
	{
		if (isset($array['controller']) && isset($array['action']))
		{
			if (isset($array['params']))
			{
				$url = action($array['controller'] . '@' . $array['action'], $array['params']);
			}
			else
			{
				$url = action($array['controller'] . '@' . $array['action']);
			}
		}
		else
		{
			$url = '#';
		}
		return $url;
	}

	public static function IsActivePage($node)
	{
		if (isset($node['controller']) && isset($node['action']) && ($node['controller'] . '@' . $node['action'] == self::GetControllerAction()))
		{
			return true;
		}
		if ($subnodes = self::Subnodes($node, true))
		{
			foreach ($subnodes as $subnode)
			{
				if ($ret = self::IsActivePage($subnode, true))
				{
					return $ret;
				}
			}
		}
		else
		{
			if (isset($node['controller']) && isset($node['action']))
			{
				return $node['controller'] . '@' . $node['action'] == self::GetControllerAction();
			}
			
		}
		
		return false;
	}

	public static function Subnodes($node = null, $with_hidden = false)
	{
		if (is_null($node))
		{
			$node = array('sub' => \Config::get('backend.navigation'));
		}

		$ret = array();
		if (isset($node['sub']) && $node['sub'])
		{
			foreach ($node['sub'] as $key => $subnode)
			{
				if ($with_hidden)
				{
					$ret[] = $subnode;
				}
				else
				{
					if (!isset($subnode['visible']) || $subnode['visible'] == true)
					{
						$ret[] = $subnode;
					}
				}
			}
		}
		return $ret;
	}

	public static function GetController()
	{
		$matches = explode('@', self::GetControllerAction());
		return $matches[0];
	}

	public static function GetAction()
	{
		$matches = explode('@', self::GetControllerAction());
		return $matches[1];
	}

	public static function SidebarHeaderText()
	{
		$controller = strtolower(self::GetController());
		$action = strtolower(self::GetAction());

		$key = 'backend.sidebar_header.' . $controller . '.' . $action;
		return trans($key);
	}

	public static function IsTranslation()
	{
		return !(Language::activeLanguage() == Language::defaultLanguage());
	}

}