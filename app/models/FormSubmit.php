<?php

class FormSubmit extends BaseModel {
	protected $fillable = array('form_id', 'data', 'ip', 'language', 'firstname', 'lastname', 'name', 'email', 'message');
	public static $map = array('form_id', 'data', 'ip', 'language', 'firstname', 'lastname', 'name', 'email', 'message');

	public static $translate = false;

	public static $order_column = 'id';
	public static $order_direction = 'desc';

	public static $has_status = false;

	public function form()
	{
		return $this->belongsTo('Form');
	}

	public function submitdata($name)
	{
		if (in_array($name, array('firstname', 'lastname', 'name', 'email', 'message')))
		{
			return $this->$name;
		}
		$obj = json_decode($this->data);
		return $obj->$name;
	}

	public function getPersonalNameAttribute($value)
	{
		if ($this->name) return $this->name;
		return $this->firstaname . ' ' . $this->lastname;
	}
}