<?php

class Form extends BaseModel {
	protected $fillable = array('title', 'tag', 'type', 'body', 'sender_name', 'sender_email', 'confirmation', 'notification_email', 'status');
	public static $map = array('title', 'tag', 'type', 'body', 'sender_name', 'sender_email', 'confirmation', 'notification_email', 'status');
	public static $translated_field = array('title', 'body', 'status');
	public static $rules = array(
        'title' =>  'required',
        'tag' =>  'required|unique:forms,tag,CUSTOM_RULE_CURRENT_ID,id',
        'type' =>  'required',
        );
	public static $has_order = false;
	public static $has_tag = true;

	public static $search_map = array();

	public function controls()
	{
		return $this->hasMany('FormControl')->active()->order();
	}

	public function submits()
	{
		return $this->hasMany('FormSubmit')->order();
	}

	public function getTokenAttribute($value)
	{
		return Illuminate\Support\Facades\Form::token();
	}

}