<?php

class Modredirect extends BaseModel {
	protected $fillable = array('from_url', 'to_url');
	public static $map = array('from_url', 'to_url');
	
	public static $translate = false;
	public static $has_order = false;
	public static $has_status = false;
}