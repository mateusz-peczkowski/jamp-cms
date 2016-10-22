<?php

class FaqCategory extends BaseModel {
	protected $fillable = array('title', 'status', 'order');
	public static $map = array('title', 'status', 'order');
	public static $translated_field = array('title', 'status');
	public static $rules = array(
        'title' =>  'required',
        );
	public static $has_order = true;
	public static $search_map = array('order');
}