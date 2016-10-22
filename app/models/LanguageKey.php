<?php

class LanguageKey extends BaseModel {
	protected $fillable = array('key', 'value', 'status');
	public static $map = array('key', 'value', 'status');
	
	public static $translated_field = array('value', 'status');
    public static $rules = array(
        'key' =>  'required|regex:/^([a-z0-9\s\_\-]+)$/|unique:language_keys,key,CUSTOM_RULE_CURRENT_ID,id,status,1',
        'value' =>  'required',
        );
	public static $has_order = false;

}