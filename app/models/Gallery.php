<?php

class Gallery extends BaseModel {
	protected $fillable = array('title', 'description', 'tag');
	public static $map = array('title', 'description', 'tag');
	public static $translated_field = array('title', 'description');
	public static $has_order = false;

	// medias in several table
	/*
	public function medias()
	{
		$ret = $this->belongsToMany('Media', 'gallery_medias')
			->withPivot('order', 'id')
			->orderBy('gallery_medias.order');

		return $ret;
	}

	public function images()
	{
		$ret = $this->belongsToMany('Media', 'gallery_medias')
			->type('i')
			->withPivot('order', 'id')
			->orderBy('gallery_medias.order');

		return $ret;
	}

	public function videos()
	{
		$ret = $this->belongsToMany('Media', 'gallery_medias')
			->type('v')
			->withPivot('order', 'id')
			->orderBy('gallery_medias.order');

		return $ret;
	}
	*/

	public function medias()
	{
		$ret = $this->hasMany('GalleryMedia')
			->order();

		return $ret;
	}


}