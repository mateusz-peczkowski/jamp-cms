<?php

class AdditionalData extends BaseModel {
    protected $fillable = array('model', 'record', 'name', 'value', 'status');
	public static $map = array('model', 'record', 'name', 'value', 'status');
    public static $search_map = array('model', 'record', 'name');
	public static $translated_field = array('value', 'status');


	public function scopeModel($query, $text)
    {
        return $query->whereModel($text);
    }

    public function scopeRecord($query, $int)
    {
        return $query->whereRecord($int);
    }

    public function scopeName($query, $text)
    {
        return $query->whereName($text);
    }
}