<?php

class Language extends BaseModel {
	protected $fillable = [];
	public static $search_map = array('is_default');
	public static $translate = false;


	public function scopeIs_default($query)
	{
		return $query->where('is_default', '=', 1);
	}

	public static function activeLanguage()
	{
		if (\Config::get('app.backend'))
		{
			if (\Input::get('language'))
			{
				return \Input::get('language');
			}
			else
			{
				return self::defaultLanguage();
			}
		}
		else
		{
			return CMS::urlLanguage();
		}
	}

	protected static $_default_language;
	public static function defaultLanguage()
	{
		if (static::$_default_language) return static::$_default_language;
		return static::$_default_language = Language::search(array('is_default' => 1), 1)->title;
	}
}