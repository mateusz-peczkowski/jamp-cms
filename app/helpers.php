<?php 
	function articlePaths() 
	{
		$obj = (object) [
			'id' => 'default',
			'title' => 'default'
		];
		$articlespaths = array($obj);
		if(File::files(app_path().'/views/frontend/articles')) {
			$files = File::files(app_path().'/views/frontend/articles');
			foreach($files as $tmppath) {
				$pathname = str_replace('.blade', '', pathinfo($tmppath)['filename']);
				$obj = (object) [
					'id' => $pathname,
					'title' => $pathname
				];
				if(!in_array($obj, $articlespaths)) {
					array_push($articlespaths, $obj);
				}
			}
		}
		View::share('articlespaths', $articlespaths);
	}
	articlePaths();

	function iconIdToName($id, $arr = 'base')
	{
	    $iconArray = Config::get('settings.'.$arr);

	    if(isset($iconArray[$id])) {
	        return $iconArray[$id];
	    }

	    return 'star';
	}
