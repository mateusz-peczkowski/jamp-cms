<?php

class FormControl extends BaseModel {
	protected $fillable = array('form_id', 'name', 'label', 'type', 'default', 'values', 'status', 'order', 'rules');
	public static $map = array('form_id', 'name', 'label', 'type', 'default', 'values', 'status', 'order', 'rules');
	public static $translated_field = array('form_id', 'label', 'default', 'values', 'status');
	public static $rules = array(
        'name' =>  'required',
        'type' =>  'required',
        );
	public static $has_order = true;

	public static $search_map = array('order', 'form_id');

	public function scopeForm_id($query, $integer)
    {
    	return $query->whereForm_id($integer);
    }

    public function form()
    {
    	return $this->belongsTo('Form');
    }

    // only frontend
    public function getHtmlAttribute($value)
    {
        if (class_exists('FForm'))
        {
        	return FForm::control($this);
        }
    }

    public function getIsRequiredAttribute($value)
    {
        $rules = explode('|', $this->rules);
        return in_array('required', $rules);
    }

}