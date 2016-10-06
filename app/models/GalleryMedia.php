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
        
    public function thumb($w, $h, $image_column = 'path', $params = array())
    {
        if (is_null($image_column))
        {
            $image_column = static::$has_image ? 'image' : null;
        }
        $imgpath = explode('/', $this->image);
        $len = sizeof($imgpath);
        $imgpathbef = '/';
        for($i = 0; $i < $len-1; $i++) {
            $imgpathbef .= $imgpath[$i].'/';
        }
        $media = \Config::get('app.media_path') . $this->$image_column;
        $pathsave = \Config::get('app.thumbs_path');
        $paththumb = public_path().$pathsave.$w.'x'.$h.$imgpathbef;
        $pathreturn = $pathsave.$w.'x'.$h.'/'.$this->$image_column;
        $pathimg = $paththumb.'/'.$imgpath[$len-1];

        if(File::exists($pathimg)) {
            return $pathreturn;
        }

        if($w == 0 || $h == 0) {
            return $media;
        }

        

        if (sizeof($params)) {
            $params = $params;
        } else {
            $params = array('crop' => true);
        }

        $size = array(
            'width' => $w,
            'height' => $h
        );

        $options = array_merge($size, $params);

        if(!File::exists($paththumb)) {
            File::makeDirectory($paththumb, $mode = 0775, true, true);
        }

        Image::make($media,$options)->save($pathimg);

        return $pathreturn;

    }

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