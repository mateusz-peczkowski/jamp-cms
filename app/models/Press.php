<?php

class Press extends BaseModel {
	protected $fillable = array('title', 'intro', 'description', 'file', 'status', 'slug', 'date', 'link');
	public static $map = array('title', 'intro', 'description', 'file', 'status', 'slug', 'date', 'link');
	public static $translated_field = array('title', 'intro', 'description', /*'slug',*/ 'status', 'date');
	public static $rules = array(
        'title' =>  'required',
        // 'date'=>	'required|date_format:"Y-m-d"',
        );
	public static $order_column = 'id';
	public static $order_direction = 'desc';
	public static $has_slug = true;
	public static $is_module = true;

	public function getFileUrlAttribute($value)
	{
		if ($this->file)
		{
			return \Config::get('app.media_path') . $this->file;
		}
	}

	public function getDescriptionAttribute($value)
	{
		return $this->formatter($value);
	}
}