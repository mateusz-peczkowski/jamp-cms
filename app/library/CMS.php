<?php
class CMS
{
	public static function resolveUrl($slug)
	{
		$url = $slug;
		if (substr($url, 0, 1) != '/')
		{
			$url = '/' . $url;
		}
		// var_dump($url); exit;

		if ($redirect = CMS::checkRedirect($url))
		{
			return $redirect;
		}

		if (Language::activeLanguage() == Language::defaultLanguage())
		{
			if ($page = Page::search(array('url' => $url, 'active' => 1), 1))
			{
				return self::render($page->controller, $page->parameters, array('page' => $page));
			}
			if ($news = News::search(array('url' => $url, 'active' => 1), 1))
			{

				return self::render($news->controller, $news->parameters, array('news' => $news));
			}
		}
		else
		{
			// dd($url);
			if ($translated_page = Page::search(array('url' => $url, 'translated' => 1), 1))
			{
				// var_dump($translated_page); exit;
				$translated = Translation::search(array('translated_id' => $translated_page->id, 'model' => 'Page', 'language' => self::urlLanguage($url)), 1);

				if ($translated)
				{
					App::setLocale($translated->language);
					$page = Page::search(array('id' => $translated->record_id, 'active' => 1), 1);

					if ($page)
					{
						return self::render($page->controller, $page->parameters, array('page' => $page));
					}
				}
			}
			if ($translated_news = News::search(array('url' => $url, 'translated' => 1), 1))
			{
				// var_dump($translated_news); exit;
				$translated = Translation::search(array('translated_id' => $translated_news->id, 'model' => 'News', 'language' => self::urlLanguage($url)), 1);

				if ($translated)
				{
					App::setLocale($translated->language);
					$news = News::search(array('id' => $translated->record_id, 'active' => 1), 1);

					if ($news)
					{
						return self::render($news->controller, $news->parameters, array('news' => $news));
					}
				}
			}
		}
		return self::Error(404);
	}

	public static function render($controller, $parameters = array(), $config = array())
	{
		if (!$controller)
		{
			$controller = 'GenericController@index';
		}
		preg_match('|(.*)@(.*)|', $controller, $matches);
		if ($matches[1] == 'Frontend_NewsController') {
			$matches[1] = 'NewsController';
		}
		$controller_name = '\Frontend_' . $matches[1];
		$controller = new $controller_name($config);
		if (is_null($parameters)) $parameters = array();
		return $controller->callAction($matches[2], $parameters);
	}

	public static function urlLanguage($url = null)
	{
		foreach (\Config::get('app.locales') as $language)
		{
			if (preg_match('|\/' . $language . '\/|', self::urlAddress()))
			{
				return $language;
			}
		}
		return \Config::get('app.locale');
	}

	public static function urlAddress()
	{
		$url = str_replace(Request::root(), '', URL::full());
		return $url;
	}

	public static function Error($status = 404)
	{
		if ($error_page = Page::byTag('error'))
		{
			return self::render($error_page->controller, $error_page->parameters, array('page' => $error_page));
		}
		return Redirect::to('/');
	}

	public static function checkRedirect($url = null)
	{
		if (is_null($url)) $url = self::urlAddress();
		if ($redirect_record = Modredirect::where('from_url', '=', $url)->first())
		{
			return \Redirect::to($redirect_record->to_url);
		}
	}

	public static function trans($key)
	{
		$cacheKey = self::getLanguageKeysCacheKey();
		if (!\Cache::has($cacheKey))
		{
			self::loadLanguageKeys($cacheKey);
		}
	
		if (isset(Cache::get($cacheKey)[$key]))
		{
			return Cache::get($cacheKey)[$key];
		}
		else
		{
			return $key;
		}
	}

	public static function getAllTranslation()
	{
		$cacheKey = self::getLanguageKeysCacheKey();
		if (!\Cache::has($cacheKey))
		{
			self::loadLanguageKeys($cacheKey);
		}
	
		return Cache::get($cacheKey);
	}

	public static function getLanguageKeysCacheKey($language = null)
	{
		return 'languageKey_' . ($language ?: Language::activeLanguage());
	}

	public static function loadLanguageKeys($cacheKey)
	{
		// lists not working with translations
		$cachedTranslations = array();
		foreach (LanguageKey::active()->get() as $languageKey)
		{
			$cachedTranslations[$languageKey->key] = $languageKey->value;
		}
		Cache::forever($cacheKey, $cachedTranslations);
	}




}