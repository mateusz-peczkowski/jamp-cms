<?php

class Page extends BaseModel {
	protected $fillable = array('title', 'body', 'tag', 'status', 'url', 'meta_title', 'meta_description', 'meta_robots', 'meta_head', 'meta_footer', 'meta_keywords');
	public static $map = array('title', 'body', 'tag', 'status', 'url', 'controller', 'view', 'meta_title', 'meta_description', 'meta_robots', 'meta_head', 'meta_footer', 'meta_keywords');
	public static $translated_field = array('title', 'body', 'url', 'status', 'meta_title', 'meta_description', 'meta_keywords');
    public static $rules = array(
        'title' =>  'required',
        // 'body'=>  'required',
        // 'url'=>    'required|unique:pages,url,CUSTOM_RULE_CURRENT_ID',
        // 'url'=>    'required|unique:pages,url,CUSTOM_RULE_CURRENT_ID,id,status,1',
        'tag'=>    'unique:pages,tag,CUSTOM_RULE_CURRENT_ID,id,status,1',
        // 'controller'=>    'required',
        // 'view'=>    'required',
        );
    public static $default_values = array(
        'title' =>  '',
        'status'    =>  1,
        );
	public static $has_order = false;
	public static $has_gallery = true;
	public static $has_tag = true;


	public static $search_map = array('url', 'active', 'translated', 'id');

    public function scopeUrl($query, $url)
    {
    	return $query->whereUrl($url);
    }

    public function getisHomeAttribute($value)
    {
    	return ($this->url == '/');
    }

    public function nodes()
    {
    	return $this->hasMany('Node');
    }

    public function breadcrumb($navigation_tag = 'base')
    {
    	$breadcrumb = array();
    	if ($navigation = Navigation::byTag($navigation_tag))
    	{
    		if ($node = Node::active()->navigation_id($navigation->id)->page_id($this->id)->first())
    		{
    			$this->breadcrumb_helper($node, $breadcrumb);
    		}
    		return $breadcrumb;
    	}
    	return false;
    }

    protected function breadcrumb_helper($node, &$breadcrumb)
    {
    	if ($parent = $node->parent)
    	{
    		$this->breadcrumb_helper($parent, $breadcrumb);
    	}
		$breadcrumb[] = $node;
    }

    public function breadcrumbs()
    {
    	$breadcrumbs = array();
    	$navigations = Navigation::active()->get();
    	foreach ($navigations as $navigation)
    	{
    		// var_dump($this->breadcrumb($navigation->tag)); exit;
    		if ($breadcrumb = $this->breadcrumb($navigation->tag))
    		{
    			$breadcrumbs[$navigation->id] = array(
    				'navigation'	=>	$navigation,
    				'breadcrumb'	=>	$breadcrumb,
    				);
    		}
    	}
    	return $breadcrumbs;
    }

    public function meta($prop)
    {
        $allow = array('title', 'description', 'robots', 'head', 'footer', 'keywords');
        if (in_array($prop, $allow))
        {
            $prop_name = 'meta_' . $prop;
            $ret = $this->$prop_name;
            if (!$ret)
            {
                if ($default_page = Page::byTag('default'))
                {
                    $ret = $default_page->$prop_name;
                }
            }
            return $ret;
        }
    }

    public function getBodyAttribute($value)
    {
        return $this->formatter($value);
    }


	/*
	public function getGalleriesAttribute()
	{
		$galleries = Gallery::leftJoin('element_galleries', 'element_galleries.gallery_id', '=', 'galleries.id')
			->where('element_galleries.model', '=', 'Page')
			->where('element_galleries.model_id', '=', $this->id)
			->select('galleries.*')
			->get();

		return $galleries;
	}
	*/

}