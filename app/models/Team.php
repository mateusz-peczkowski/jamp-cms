<?php

class Team extends BaseModel {
	protected $fillable = array('firstname', 'lastname', 'position', 'description', 'image', 'status', 'order');
	public static $map = array('firstname', 'lastname', 'position', 'description', 'image', 'status', 'order');
	public static $translated_field = array('description', 'position', 'status');

	public static $has_image = true;

	public static $search_map = array('order');

	public function getDescriptionAttribute($value)
	{
		return $this->formatter($value);
	}
}