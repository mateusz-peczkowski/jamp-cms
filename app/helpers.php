<?php 
	function homePage($ret) 
	{
		$homePage = Page::byTag('homePage') ? : false;
		if($ret) {
			return $homePage;
		} else {
			View::share('homePage', $homePage);
		}
	}
	function defaultPage($ret) 
	{
		$defaultpage = Page::byTag('default') ? : homePage(true);
		if($ret) {
			return $defaultpage;
		} else {
			View::share('defaultpage', $defaultpage);
		}
	}

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

	function iconIdToName($id, $arr = 'base')
	{
	    $iconArray = Config::get('settings.'.$arr);

	    if(isset($iconArray[$id])) {
	        return $iconArray[$id];
	    }

	    return 'star';
	}

	function socials()
	{
		$defaultpage = defaultPage(true);
	    $cntSocial = 0;
	    if($defaultpage) {
		    $socialArray = array(
		        'fb' => $defaultpage->data('facebook_link'),
		        'in' => $defaultpage->data('instagram_link'),
		        'yt' => $defaultpage->data('youtube_link'),
		        'sn' => $defaultpage->data('snapchat_link')
		    );
		    foreach($socialArray as $social) {
		        if($social) {
		            $cntSocial++;
		        }
		    }
			View::share('socialArray', $socialArray);
			View::share('cntSocial', $cntSocial);
	    }
	}

	use Jenssegers\Agent\Agent;
	View::share('agent', new Agent());
	// dd($agent->isTablet());
	// dd($agent->isMobile());

	// dd(time());
	View::share('VERSION', '');
