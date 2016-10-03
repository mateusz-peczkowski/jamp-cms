<?php

class GalleryMedia extends BaseModel {
	protected $fillable = array('title', 'description', 'link', 'link_title', 'type', 'path', 'order', 'gallery_id');
	public static $map = array('title', 'description', 'link', 'link_title', 'type', 'path', 'order', 'gallery_id');
	public static $translated_field = array('title', 'description', 'link', 'link_title');
    public static $search_map = array('gallery_id', 'order');
    public static $has_status = false;
    public static $has_image = true;

	// scopes
    public function scopeType($query, $type)
    {
    	return $query->whereType($type);
    }

    public function scopeGallery_id($query, $id)
    {
        return $query->whereGallery_id($id);
    }

    public function thumb($w, $h, $image_column = 'path', $params = array())
    {
        if (!is_null($image_column))
        {
            if (sizeof($params)) {
                $params = $params;
            } else {
                $params = array('crop');
            }

            if($w == null && $h == null) {
                return \Config::get('app.media_path') . $this->$image_column;
            }

            if (!is_null($image_column) && $this->$image_column && $w && $h)
            {
                return Image::url((\Config::get('app.media_path') . $this->$image_column),$w,$h,$params);
            }
        }

        return \Config::get('app.media_path') . $this->$image_column;

    }

    public function getOriginalAttribute($value)
    {
        return $this->path_to_file('path');
    }

    public function getIsVideoAttribute($value)
    {
        if ($this->type)
        {
            return explode('/', $this->type)[0] == 'video';
        }
    }



    // public function image($w = null, $h = null)
    // {
    // 	if (is_null($w) && is_null($h))
    // 	{
    // 		return \Config::get('app.media_path') . $this->path;
    // 	}
    // 	else
    // 	{
    // 		// thumb
    // 	}
    // }
}