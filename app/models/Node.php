<?php

class Node extends BaseModel {
	protected $fillable = array('page_id', 'navigation_id', 'parent_id', 'order', 'status');
	public static $map = array('page_id', 'navigation_id', 'parent_id', 'order', 'status');
	public static $search_map = array('page_id', 'navigation_id', 'parent_id', 'order');
	public static $rules = array(
        'page_id' =>  'required',
        'navigation_id'=>  'required',
        );

	// scopes
    public function scopeParent_id($query, $number = null)
    {
    	return is_null($number) ? $query->whereNull('parent_id') : $query->whereParent_id($number);
    }

    public function scopeParent($query, $number = null)
    {
    	return $this->scopeParent_id($query, $number);
    }

    public function scopeNavigation_id($query, $number)
    {
        return $query->whereNavigation_id($number);
    }

    public function scopePage_id($query, $number)
    {
    	return $query->wherePage_id($number);
    }

    // relations
    public function subnodes()
	{
		return $this->hasMany('Node', 'parent_id')
			->parent($this->id)
			->order();
	}

    public function parent()
    {
        return $this->belongsTo('Node', 'parent_id');
    }

	public function page()
	{
		return $this->belongsTo('Page');
	}

    public function navigation()
    {
        return $this->belongsTo('Navigation', 'navigation_id');
    }


	// Accessor
	public function getTitleAttribute($value)
    {
        return $this->page->title;
    }

    public function getUrlAttribute($value)
    {
        return $this->page->url;
    }

    // only frontend
    public function getIsActiveAttribute($value)
    {
        $active_page = \Config::get('app.global_page');
        $breadcrumb = $active_page->breadcrumb($this->navigation->tag);
        foreach ($breadcrumb as $bc)
        {
            if ($bc->id == $this->id)
            {
                return true;
            }
        }
        return false;
    }

}