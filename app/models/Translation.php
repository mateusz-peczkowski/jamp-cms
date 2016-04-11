<?php

class Translation extends BaseModel {
	protected $fillable = [];
	public static $search_map = array('language', 'model', 'record_id', 'translated_id');
	public static $translate = false;

	public function scopeLanguage($query, $locale)
	{
		return $query->whereLanguage($locale);
	}

	public function scopeModel($query, $model)
	{
		return $query->whereModel($model);
	}

	public function scopeRecord_id($query, $record_id)
	{
		return $query->whereRecord_id($record_id);
	}

	public function scopeTranslated_id($query, $translated_id)
	{
		return $query->whereTranslated_id($translated_id);
	}

}