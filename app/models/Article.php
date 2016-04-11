<?php

class Article extends BaseModel {
	protected $fillable = array('title', 'intro', 'description', 'tag', 'image', 'status', 'link');
	public static $map = array('title', 'intro', 'description', 'tag', 'image', 'status', 'link');
	public static $translated_field = array('title', 'intro', 'description', 'status', 'link');
    public static $rules = array(
        'title' =>  'required',
        'tag'=>    'unique:articles,tag,CUSTOM_RULE_CURRENT_ID,id,status,1',
        );
	public static $has_order = false;
	public static $has_gallery = true;
	public static $has_image = true;
	public static $has_tag = true;

	public static $default_values = array(
		'title'	=>	'',
		'status'	=>	1,
		);
	
	public function getIntroAttribute($value)
	{
		return $this->formatter($value);
	}

	public function getDescriptionAttribute($value)
	{
		return $this->formatter($value);
	}
}