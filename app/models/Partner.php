<?php

class Partner extends BaseModel {
	protected $fillable = array('title', 'image', 'link', 'status', 'order');
	public static $map = array('title', 'image', 'link', 'status', 'order');
	public static $translated_field = array('title', 'status');
	public static $rules = array(
        'title' =>  'required',
        );
	public static $has_image = true;

	public static $search_map = array('order');

}