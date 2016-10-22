<?php

class Profile extends BaseModel {
	protected $fillable = array('title', 'model', 'definition', 'order');
	public static $map = array('title', 'model', 'definition', 'order');
	public static $translate = false;
	public static $has_status = false;
	public static $rules = array(
        'title' =>  'required',
        'model' =>  'required',
        'definition' =>  'required',
        );

	public static $search_map = array('model', 'order');

	public function scopeModel($query, $string)
    {
    	return $query->whereModel($string);
    }

    public function def($name)
    {
    	try 
    	{
    		if ($def = json_decode($this->definition, true))
    		{
    			if (isset($def[$name]))
    			{
    				return $def[$name];
    			}
    		}
    		
    	}
    	catch (Exception $e)
    	{
    		
    	}
    }

    public function fields()
    {
        $ret = array();
        try 
        {
            if (json_decode($this->definition, true))
            {
                $ret = json_decode($this->definition, true);
            }
        }
        catch (Exception $e)
        {
            
        }
        return $ret;
    }

}