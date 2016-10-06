<?php

class BaseModel extends \Eloquent {
	protected $fillable = [];
	public static $translated_field = array();

	public static $order_column = 'order';
	public static $order_direction = 'asc';
	public static $translate = true;
	public static $has_order = true;
	public static $has_status = true;
	public static $has_gallery = false;
	public static $has_slug = false;
	public static $has_tag = false;
	public static $is_module = false;
	public static $has_image = false;
	public static $title_column = 'title';

	public function scopeActive($query, $param = 1)
    {
    	if (static::$has_status)
    	{
        	return $query->whereStatus(1);
        }
    	return $query;
    }

    public function scopeBackend($query, $param = 1)
    {
    	if (static::$has_status)
    	{
        	return $query->whereIn('Status', array(0,1));
        }
    	return $query;
    }

    public function scopeLimit($query, $int)
    {
    	if ($int)
    	{
    		$query = $query->take($int);
    	}
    	return $query;
    }

    public function scopeTranslated($query, $param = 1)
    {
        return $query->whereStatus(3);
    }

    public function scopeId($query, $id)
    {
        return $query->whereId($id);
    }

    public function scopeSlug($query, $slug)
    {
    	if (static::$has_slug)
    	{
    		return $query->whereSlug($slug);
    	}
    	return $query;
    }

    public function scopeTag($query, $tag)
    {
    	if (static::$has_tag)
    	{
    		return $query->whereTag($tag);
    	}
    	return $query;
    }

    public function scopeOrder($query, $params = array())
    {
    	// TODO: check all model
    	// if (static::$has_order)
    	// {
	    	$column = isset($params[0]) ? $params[0] : static::$order_column;
	    	$direction = isset($params[1]) ? $params[1] : static::$order_direction;
	        return $query->orderBy($column, $direction);
    	// }
    	// return $query
    }

    public static function search($search_params, $number_of_records = null, $params = null)
	{
		$filtered_params = static::searchFilterParams($search_params);
		// var_dump($filtered_params, $search_params);
		$results = static::query();
		$ret = null;
		foreach ($filtered_params as $key => $value)
		{
			$results = $results->$key($value);
		}

		if ($number_of_records == 1)
		{
			$results = $results->first();
		}
		else
		{
			if (!is_null($number_of_records))
			{
				$results = $results->limit($number_of_records);
			}
			$results = $results->get();
		}


		if (!is_null($params))
		{
			if (isset($params['to_array']))
			{
				$results->each(function($record) use ($params, &$ret){

					$ret[$record->{$params['to_array'][0]}] = $record->{$params['to_array'][1]};

				});
			}
		}
		else
		{
			$ret = $results;
		}
		return $ret;

	}

    public static function searchFilterParams($params)
	{
		$filtered_params = array();
		foreach (static::$search_map as $search_param)
		{
			if (isset($params[$search_param]))
			{
				$filtered_params[$search_param] = $params[$search_param];
			}
		}

		return $filtered_params;
	}

	// translated model
	public function setRawAttributes(array $attributes, $sync = false)
	{
		parent::setRawAttributes($attributes, $sync);

		if (
				static::$translate && sizeof($attributes) 
				&& (
						(isset($attributes['status']) && $attributes['status'] != 3)
						// || !isset($attributes['status'])
					)
			)
		{
			if (Language::activeLanguage() != Language::defaultLanguage())
			{
				//load translations record(s)
				$translations = DB::table('translations')
					->whereLanguage(Language::activeLanguage())
					->whereModel(get_class($this))
					->whereRecord_id($attributes['id'])
					->first();					

				if ($translations)
				{
					// get translated record
					$translated_record = static::translated()->find($translations->translated_id);
					// $translated_record = DB::table('pages')->whereId($translations->translated_id)->first();
					if ($translated_record)
					{
						// override only translated field
						foreach (static::$translated_field as $field)
						{
							// override only if isset translation
							if ($translated_record->$field)
							{
								$this->$field = $translated_record->$field;
							}
						}
					}
				}
			}
		}
	}

	public static function modelSaveFilterParams($input)
	{
		if (
				(isset($input[static::ModelName() . '__status']) && $input[static::ModelName() . '__status'] == 3)
				|| (isset($input['status']) && $input['status'] == 3)
			)
		{
			// translation
			$map = static::$translated_field;
		}
		else
		{
			// normal
			$map = static::$map;
		}
		$ret = array();
		foreach ($map as $field)
		{
			if (isset($input[static::ModelName() . '__' . $field]))
			{
				$ret[$field] = $input[static::ModelName() . '__' . $field];
			}
			elseif (isset($input[$field]))
			{
				$ret[$field] = $input[$field];
			}
		}
		return $ret;
	}

	public static function getValidationRules($input, $id)
	{
		if (isset(static::$rules))
		{
			// validate only fields in $input
			$rules = array_intersect_key(static::$rules, $input);
	
	   		foreach ($rules as $key => $value)
	   		{
	   			// change CURRENT_ID -> $id
	    		$rules[$key] = str_replace('CUSTOM_RULE_CURRENT_ID', $id, $value);
	   		}
	   		return $rules;
		}
	}

	public static function getModelDefaultValues()
	{
		$ret = array();
		foreach(static::$default_values as $key => $value)
		{
			$ret[$key] = $value ?: trans('backend.default_values.' . strtolower(static::ModelName()) . '.' . $key);
		}
		return $ret;
	}

	public static function createNew($input = array(), $attributes = array())
	{
		if (!$input)
		{
			$input = static::getModelDefaultValues();
		}

		$obj = new static;
		$obj = self::modelSaveHelper($obj, $input);

		if (!$obj->save())
		{
			// fail
			$ret['status'] = 'ERROR';
			$ret['message'] = 'error_create_object';
		}
		else
		{
			$ret['object'] = $obj;
			$ret['status'] = 'OK';
			$ret['message'] = 'created';
			$ret['action'] = 'CREATE';
			if (!isset($attributes['redirect']) || $attributes['redirect'] == 'default')
			{
				$route = preg_replace('|@.*|', '@edit', Route::currentRouteAction());
				$ret['redirect'] = action($route, array($obj->id));
			}
			elseif ($attributes['redirect'])
			{
				$ret['redirect'] = $attributes['redirect'];
			}
		}
		return $ret;
	}

	public static function modelSave($id, $input, $attributes = array())
	{
		// filter params
		$input = static::modelSaveFilterParams($input);

		$ret = array();
		$ret['status'] = '';
		$ret['message'] = '';
		$ret['action'] = '';

		if ($rules = static::getValidationRules($input, $id))
		{
			$validator = Validator::make($input, $rules);

			if ($validator->fails())
			{
				// The given data did not pass validation
				$ret['status'] = 'ERROR';
			    $ret['message']	= static::rebuildValidatorMessages($validator->messages());
				$ret['action'] = '';

				return $ret;
			}
		}
    
		if (is_null($id))
		{
			// create new
			$ret = static::createNew($input, $attributes);
		}
		else
		{
			$obj = static::find($id);

			if (!$obj)
			{
				// no object
				$ret['status'] = 'ERROR';
				$ret['message'] = 'error_non_object';	
			}
			else
			{
				if (isset($input['action']) && $input['action'] == 'delete')
				{
					// TODO: delete translation (if field delete all record fields)
					
					// delete/change status -> 2
					$obj->status = 2;

					// check model has OrderIndex
					if (static::$has_order)
					{
						$obj->order = null;
					}

					if (!$obj->save())
					{
						// error in delete
						$ret['status'] = 'ERROR';
						$ret['message'] = 'error_deleted';	
					}
					else
					{
						$ret['status'] = 'OK';	
						$ret['message'] = 'deleted';
						$ret['action'] = 'DELETE';
					}

				}
				else
				{
					// if isTranslation && not save translation
					if (Language::activeLanguage() != Language::defaultLanguage() 
						&& (
								(isset($input['status']) && $input['status'] != 3)
								|| !isset($input['status'])
					 		)
					 	)
					{
						// translation		
						$ret = static::translationSave($obj, $input, $attributes);
					}
					else
					{
						// normal update
						$obj = self::modelSaveHelper($obj, $input);
						if (!$obj->save())
						{
							// save error
							$ret['status'] = 'ERROR';
							$ret['message'] = 'error_updated';
						}
						else
						{
							$ret['status'] = 'OK';	
							$ret['message'] = 'updated';
							$ret['action'] = 'UPDATE';
						}
					}
				}
			}
		}
		if (isset($ret['message']))
		{
			$ret['message'] = trans('backend.' . $ret['message']);
		}
		return $ret;
	}

	protected static function translationSave($obj, $input, $attributes)
	{
		$ret = array();
		$ret['status'] = '';
		$ret['message'] = '';	
	
		// mapped
		if ($trans_record = Translation::search(array('language' => Language::activeLanguage(), 'record_id' => $obj->id, 'model' => get_class($obj)), 1))
		{
			// update
			$input['status'] = 3;
			$trans_ret = static::modelSave($trans_record->translated_id, $input, $attributes);
			$ret['message'] = 'trans_updated';
			$ret['status'] = $trans_ret['status'];
			$ret['action'] = 'UPDATE';

		}
		else
		{
			// create mapped record
			$input['status'] = 3;
			$trans_ret = static::modelSave(null, $input, $attributes);

			// create translation record
			$obj_trans = new Translation;

			$obj_trans->model = get_class($obj);
			$obj_trans->language = Language::activeLanguage();
			$obj_trans->record_id = $obj->id;
			$obj_trans->translated_id = $trans_ret['object']->id;

			if (!$obj_trans->save())
			{
				// error
				$ret['status'] = 'ERROR';
				$ret['message'] = 'error_trans_created';	
			}
			else
			{
				$ret['status'] = 'OK';	
				$ret['message'] =  'trans_created';	
				$ret['action'] = 'UPDATE';
			}


		}
		return $ret;

	}

	protected static function modelSaveHelper($obj, $input)
	{
		// if (isset($input['status']) && $input['status'] == 3)
		// {
		// 	// translation save
		// }
		foreach ($input as $key => $value)
		{
			$obj->$key = $value;
		}
		return $obj;
	}


	public static function ModelName()
	{
		return get_class(static::getModel());
	}


	public function first_gallery()
	{
		if (static::$has_gallery)
		{
			$gallery = Gallery::leftJoin('element_galleries', 'element_galleries.gallery_id', '=', 'galleries.id')
			->where('element_galleries.model', '=', static::ModelName())
			->where('element_galleries.model_id', '=', $this->id)
			->orderBy('order')
			->select('galleries.*')
			->first();

		return $gallery;
		}
	}

    public function connection($model, $only_active = 1, $limit = null)
    {
    	$connection = Connection::where('model1', '=', get_class($this))
    							->where('record1', '=', $this->id)
    							->where('model2', '=', $model)
    							->order()
    							// ->lists('record2', 'order');
    							->lists('record2');
    		// dd($connection);

    	if ($connection)
    	{
    		$records = $model::query();

    		if ($only_active)
    		{
    			$records = $records->active();
    		}
    		else
    		{
    			$records = $records->backend();
    		}
    		$records = $records->whereIn('id', $connection)
    			->orderByRaw(DB::raw("FIELD(id, " . implode(',', $connection) .")"));

    		if (!is_null($limit))
    		{
    			if ($limit == 1)
    			{
    				$records = $records->first();
    			}
    			else
    			{
    				$records = $records->limit($limit)->get();
    			}
    		}
    		else
    		{
    			$records = $records->get();
    		}

    		// uncomment if order should order
    		// $flip_connection = array_flip($connection);

    		// foreach ($records as $record)
    		// {
    		// 	$record->connection_order = $flip_connection[$record->id];
    		// }

    		return $records;
    	}
    	else
    	{
    		return array();
    	}
    }

    public function connected($model, $only_active = 1, $count = null)
    {
    	$connection = Connection::where('model2', '=', get_class($this))
    							->where('record2', '=', $this->id)
    							->where('model1', '=', $model)
    							->order()
    							// ->lists('record2', 'order');
    							->lists('record1');
    		// dd($connection);

    	if ($connection)
    	{
    		$records = $model::query();

    		if ($only_active)
    		{
    			$records = $records->active();
    		}
    		else
    		{
    			$records = $records->backend();
    		}
    		$records = $records->whereIn('id', $connection)
    			->orderByRaw(DB::raw("FIELD(id, " . implode(',', $connection) .")"));

 			if (is_null($count))
 			{
 				$records = $records->get();
 			}
 			else
 			{
 				// TODO:get count elements
 				$records = $records->first();
 			}

    		// uncomment if order should order
    		// $flip_connection = array_flip($connection);

    		// foreach ($records as $record)
    		// {
    		// 	$record->connection_order = $flip_connection[$record->id];
    		// }

    		return $records;
    	}
    	else
    	{
    		if (is_null($count))
 			{
 				return array();
 			}
 			else
 			{
 				return new $model;
 			}
    	}
    }

    public function path_to_file($image_column)
    {
    	return \Config::get('app.media_path') . $this->$image_column;
    }

    public function thumb($w, $h, $image_column = null, $params = array())
    {
    	if (is_null($image_column))
        {
            $image_column = static::$has_image ? 'image' : null;
        }
        $media = \Config::get('app.media_path') . $this->$image_column;
        $pathsave = \Config::get('app.thumbs_path');
        $paththumb = public_path().$pathsave.$w.'x'.$h;
        $pathreturn = $pathsave.$w.'x'.$h.'/'.$this->$image_column;
        $pathimg = $paththumb.'/'.$this->$image_column;

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

    // additional data
    public function data($name)
    {
    	$search_params = array(
    		'model' 	=> static::ModelName(),
    		'record' 	=> $this->id,
    		'name' 		=> $name,
    		);
    	if ($data = AdditionalData::search($search_params, 1))
    	{
    		return $data->value;
    	}
    }

    public function all_datas()
    {
    	$search_params = array(
    		'model' 	=> static::ModelName(),
    		'record' 	=> $this->id,
    		);
    	return $data = AdditionalData::search($search_params);
    }

    public function profiles()
    {
    	return Profile::search(array('model' => static::ModelName()), null, array('to_array' => array('id', 'title')));
    }

    public function profile()
    {
    	return $this->connection('Profile', 1, 1);

    }

	// Accessor
	public function getUrlAttribute($value)
    {
    	if (static::$is_module)
    	{
	    	$page = Page::active()->tag(static::ModelName())->first();
	    	if ($page)
	        	return $page->url . '/' . $this->slug;
    	}
    	return $value;
    }


    // methods

    // cache all data byTag
    public static $cache_byTag = array();
    public static function byTag($text)
    {
    	if (static::$has_tag)
    	{
    		$model_name = static::ModelName();
    		if (!isset(static::$cache_byTag[$model_name])) static::$cache_byTag[$model_name] = array();
     		if (array_key_exists($text, static::$cache_byTag[$model_name])) return static::$cache_byTag[$model_name][$text];
    		return static::$cache_byTag[$model_name][$text] = static::active()->tag($text)->first();
    	}
    	return false;
    }


    // validator
    public static function rebuildValidatorMessages($messages)
    {
    	$new_messages = array();
    	foreach ($messages->toArray() as $key => $field_messages)
    	{
    		$new_messages[static::ModelName() . '__' . $key] = $field_messages;
    	}
    	return $new_messages;
    }



    protected function formatter($value)
    {
    	if (!\Config::get('app.backend'))
		{
			// change media path
			return str_replace('../../../source/', \Config::get('app.media_path'), $value);
		}
		return $value;
    }


}