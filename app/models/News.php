<?php

class News extends BaseModel {
	protected $fillable = array('title', 'description', 'intro', 'image', 'url', 'published_from', 'published_to', 'status', 'slug', 'date', 'order');
	public static $map = array('title', 'description', 'intro', 'image', 'url', 'published_from', 'published_to', 'status', 'slug', 'date', 'order');
	public static $translated_field = array('title', 'description', 'intro', 'url', /*'slug',*/ 'status', 'date');
	public static $rules = array(
		'title'	=>	'required',
		// 'description'=>	'required',
		// 'image'=>	'required',
		// 'author'=>	'required',
		// 'published_from'=>	'date_format:"Y-m-d h:i:s"',
		// 'published_from'=>	'required|date_format:"Y-m-d"',
		// 'date'=>	'required|date_format:"Y-m-d"',
		// 'published_to'=>	'required',
		// 'status'=>	'required',
		// 'slug'=>	'required|unique:news',
		);


	// public static $has_order = false;
	public static $default_values = array(
        'title' =>  '',
        'status'    =>  1,
        );
	public static $has_gallery = true;
	public static $has_slug = true;
	public static $is_module = true;
	public static $has_image = true;
	public static $has_order = true;
    public static $search_map = array('url', 'active', 'translated', 'id');

	public function getDescriptionAttribute($value)
	{
		return $this->formatter($value);
	}

	public function scopeUrl($query, $url)
    {
    	return $query->whereUrl($url);
    }

}