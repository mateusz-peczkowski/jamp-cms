<?php
class JForm
{
	// public function __construct($context, $attributes)
	// {

	// }

	public static function Initialize($attributes = array())
	{

	}

	public static function FormOpen($action = '', $method, $attributes = array())
	{
		if (\Input::get('language'))
		{
			$action .= '?language=' . \Input::get('language');
		}
		// $class = self::GetClass($attributes, 'form-horizontal form-bordered');
		$class = self::GetClass($attributes, 'form-edit form-bordered');
		$ret = '<form action="' . $action . '" method="' . $method . '" class="' . $class . '">';
		return $ret;
	}

	public static function ModalFormOpen($action = '', $method, $attributes = array())
	{
		return self::FormOpen($action, $method, array('class' => ''));
	}

	public static function FormClose()
	{
		$ret = '</form>';
		return $ret;
	}

	public static function FormButtons()
	{
		// $ret = '<div class="form-group form-actions">
  //                   <div class="col-md-9 col-md-offset-3">
  //                       <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
  //                       <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
  //                   </div>
  //               </div>';

        $ret = '<div class="form-group form-actions">
                    <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
                    <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                </div>';
	    return $ret;
	}

	public static function ControlInitialize($name, $object, $attributes = array())
	{
		$initialize = array(
			'value'	=>	'',
			'disabled' => '',
			);

		// value
		$initialize['value'] = self::GetValue($name, $object);

		// disable
		$model = self::GetModel($name);
		$key = self::GetKey($name);
		if ((isset($attributes['disabled']) && $attributes['disabled']) || (!in_array($key, $model::$translated_field) && Backend::IsTranslation()))
		{
			$initialize['disabled'] = ' disabled ';
		}
		
		return $initialize;
	}

	public static function Text($name, $object, $attributes = array())
	{
		$initialize = self::ControlInitialize($name, $object, $attributes);
		
		$ret = '<input type="text" name="' . $name . '" value="' . $initialize['value'] . '" ' . $initialize['disabled'] . ' class="form-control" placeholder="Text">';
		return self::FormRow($name, $ret, $attributes);
	}

	public static function TextArea($name, $object, $attributes = array())
	{
		$initialize = self::ControlInitialize($name, $object, $attributes);
		
		$ret = '<textarea name="' . $name .'"' . $initialize['disabled'] . ' rows="7" class="form-control" placeholder="Text">' . $initialize['value'] . '</textarea>';
		return self::FormRow($name, $ret, $attributes);
	}

	public static function Editor($name, $object, $attributes = array())
	{
		$initialize = self::ControlInitialize($name, $object, $attributes);

		$class = $initialize['disabled'] ? 'editor_disabled' : 'editor';
		$ret = '<textarea name="' . $name . '"  class="' . $class . '" ' . $initialize['disabled'] . '>' .  $initialize['value'] . '</textarea>';
		return self::FormRow($name, $ret, $attributes);
	}

	public static function Hidden($name, $object, $attributes = array())
	{
		if (is_object($object))
		{
			$initialize = self::ControlInitialize($name, $object, $attributes);
			$value = $initialize['value'];
		}
		else
		{
			$value = $object;
		}

		$ret = '<input type="hidden" name="' . $name . '" value="' . $value . '">';
		return $ret;
	}

	public static function Select2($name, $object, $attributes = array())
	{
		$initialize = self::ControlInitialize($name, $object, $attributes);

		$el = $attributes['elements'];
		$ret = '<select id="example-select2" name="' . $name . '" ' . $initialize['disabled'] . ' class="select-select2" style="width: 100%;" data-placeholder="'. trans('backend.chooseone') .'...">
                    <option></option>';

        foreach ($el as $key => $e)
        {

        	// if (is_object($e))
        	// {
	        // 	$value = $e->id;
	        // 	$title = $e->title;
        	// }
        	// else
        	// {
        	// 	$value = $key;
	        // 	$title = $e;	
        	// }
        	// $ret .= '<option value="' . $value . '">' . $title .'</option>';
        	if (is_object($e))
        	{
        		$id = $e->id;
        		$title = $e->title;
        	}
        	else
        	{
        		$id = $key;
        		$title = $e;
        	}

    		$selected = $initialize['value'] == $id ? 'selected' : '';
    		$ret .= '<option value="' . $id . '" ' . $selected . '>' . $title .'</option>';
        }
        $ret .= '</select>';

		return self::FormRow($name, $ret, $attributes);
	}

	public static function Date($name, $object, $attributes = array())
	{
		$initialize = self::ControlInitialize($name, $object, $attributes);

		$ret = '<input type="text" name="' . $name . '" value="' . $initialize['value'] . '" class="form-control input-datepicker" ' . $initialize['disabled'] . ' data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">';
		return self::FormRow($name, $ret, $attributes);
	}

	public static function Label($name, $object, $attributes = array())
	{
		$initialize = self::ControlInitialize($name, $object, $attributes);

		$ret = '<p class="form-control-static">' . $initialize['value'] .'</p>';
		return self::FormRow($name, $ret, $attributes);
	}

	public static function CheckBox($name, $object, $attributes = array())
	{
		// checkbox with hidden, can save field 0 value, attach by checkbox name = hidden#id
		$initialize = self::ControlInitialize($name, $object, $attributes);
		
		$checked = $initialize['value'] ? 'checked' : '';
		$ret = '<div><label class="switch switch-info"><input class="checkbox-control" type="checkbox" value="1" id="' . $name . '" ' . $checked . ' ' . $initialize['disabled'] . '><span></span></label></div>';
		if (!$initialize['disabled'])
		{
			$ret .= self::Hidden($name, $object);
		}

		return self::FormRow($name, $ret, $attributes);
	}

	public static function FileManager($name, $object, $attributes = array())
	{
		$initialize = self::ControlInitialize($name, $object, $attributes);

		$ret = '<input type="text" class="form-control" placeholder="Path" name="' . $name . '" value="' . $initialize['value'] . '" id="' . $name . '" ' . $initialize['disabled'] . '>';
		if (!$initialize['disabled'])
		{
			$ret .= '<a href="' . \Config::get('app.filemanager.path') . 'type=2&amp;field_id=' . $name . '" class="btn filemanager_jamp" type="button">' . trans('backend.select') . '</a>';
		}
		return self::FormRow($name, $ret, $attributes);
		
	}

	public static function FormRow($name, $control, $attributes)
	{
		$ret = '<div class="form-group">';

		$label = isset($attributes['label']) ? $attributes['label'] : self::GetTranslationKey($name);
		$ret .= self::FormLabel($label);

		$col = isset($attributes['col']) ? $attributes['col'] : 'col-xs-9';
		// $ret .= self::Col($col, $control);
		$ret .= $control;

		$ret .= '</div>';
		return $ret;
	}

	public static function FormLabel($label)
	{
		// $ret = '<label class="col-md-3 control-label" for="example-select2">Select2</label>';
		$ret = '<label class="control-label">' . $label . '</label>';
		return $ret;
	}

	public static function Col($col, $control)
	{
		$ret = '<div class="' . $col . '">';
		$ret .= $control;
		$ret .= '</div>';
		return $ret;
	}

	public static function BlockOpen($attributes = array())
	{
		$id = self::GetProperty('id', $attributes);
		$ret = '<div class="block" id="' . $id . '">';
		$ret .= self::BlockTitle($attributes);
		return $ret;
	}

	public static function BlockClose()
	{
		return '</div>';
	}

	public static function BlockTitle($attributes = array())
	{
		$ret = '<div class="block-title">';
		if (isset($attributes['languages']) && sizeof($attributes['languages']) > 1)
		{
			$ret .= self::LanguageToolbar($attributes['languages']);
		}
		if (isset($attributes['tabs']))
		{
			$ret .= self::Tabs($attributes['tabs']);
		}
		elseif (isset($attributes['text']))
		{
			$ret .= '<h2>';
			$ret .= $attributes['text'];
			$ret .= '</h2>';
		}
		$ret .= '</div>';
		return $ret;
	}

	public static function Toolbar($buttons)
	{
		$ret = '<div class="block-section">
                    <div class="btn-toolbar">
                        <div class="btn-group">';
        foreach ($buttons as $button)
        {
        	$button['class'] = self::GetClass($button, 'btn btn-default');
        	$ret .= self::Button($button);
        }
            
        $ret .=         '</div>
                    </div>
                </div>';
        return $ret;
	}

	public static function BuildUrl($array)
	{
		$url = self::GetProperty('url', $array);
		$params = self::GetProperty('params', $array);

		$ret = $url;
		if ($params)
		{
			$ret .=  '?' . http_build_query($params);
		}
		return $ret;
	}

	public static function Button($button)
	{
		$url = self::BuildUrl($button);
		$id = self::GetProperty('id', $button, '') ? 'id="' . self::GetProperty('id', $button, '') . '"' : '';
		$tooltip = self::GetProperty('tooltip', $button) ? 'data-toggle="tooltip" title="' . self::GetProperty('tooltip', $button) . '"' : '';
        $ret = '<a href="' . $url . '" class="' . self::GetClass($button) . '"' . $tooltip . ' ' . $id . '>
        				<i class="' . \Config::get('backend.toolbar.buttons.' . $button['type']) . '"></i> ';
        if (isset($button['text']))
        {
        	$ret .= $button['text'];
        }
        $ret .= '</a>';
        return $ret;
	}

	public static function GetClass($array, $default = '')
	{
		return self::GetProperty('class', $array, $default);
	}

	public static function GetProperty($prop, $array, $default = '')
	{
		return (isset($array[$prop])) ? $array[$prop] : $default;
	}

	public static function GetKey($string)
	{
		$explode = explode('__', $string);
		return end($explode);
	}

	public static function GetModel($string)
	{
		$explode = explode('__', $string);
		return $explode[0];
	}

	public static function GetValue($string, $object)
	{
		if (is_object($object))
		{
			$key = self::GetKey($string);
			return $value = $object->$key;
		}
		else
		{
			return $object;
		}
	}

	public static function GetTranslationKey($string)
	{
		$t_key = /*'backend.' . */str_replace('__', '.', strtolower($string));

		if (Lang::has($t_key))
		{
			return trans($t_key);
		}
		// TODO 
		// if backend.page.title not exists backend.title
		return trans('backend.' . $t_key);
	}

	public static function Tabs($tabs, $attributes = array())
	{
		$id = self::GetProperty('tabs_id', $attributes);
		$ret = '<ul class="nav nav-tabs" id="' . $id . '">';
		foreach ($tabs as $tab)
		{
			$active = self::GetProperty('active', $tab, '') ? 'active' : '';
			$class = self::GetProperty('class', $tab);
			$data_id = self::GetProperty('data-id', $tab);
			$url = self::BuildUrl($tab);
			$ret .= '<li class="' . $active . ' ' . $class . '" data-id="' . $data_id . '"><a href="' . $url . '">' . $tab['title'] . '</a></li>';

		}
		$ret .= '</ul>';
        return $ret;
	}

	public static function LanguageToolbar($languages)
	{
		$ret = '<div class="block-options pull-right">';
		foreach ($languages as $language)
		{
			$active = $language == Language::activeLanguage() ? 'active' : '';
			$ret .= '<a href="' . \URL::current() . '?language=' . $language . '" class="btn btn-effect-ripple ' . $active . '">' . $language . '</a>';
		}
		$ret .= '</div>';
        return $ret;
	}

	public static function Pills($pills)
	{
		$ret = '<div class="block-section">';
        $ret .= '<ul class="nav nav-pills">';
        foreach ($pills as $pill)
        {
        	$active = self::GetProperty('active', $pill) ? 'active' : '';
        	$url = self::BuildUrl($pill);
        	$title = self::GetProperty('title', $pill);
        	$ret .= '<li class="' . $active . '"><a href="' . $url . '">' . $title . '</a></li>';
        }
        $ret .= '</ul>
                </div>';
        return $ret;
	}

	public static function SuccessAlert($text)
	{
		return self::Alert('success', $text);
	}

	public static function InfoAlert($text)
	{
		return self::Alert('info', $text);
	}

	public static function WarningAlert($text)
	{
		return self::Alert('warning', $text);
	}

	public static function DangerAlert($text)
	{
		return self::Alert('danger', $text);
	}


	public static function Alert($messageType, $text)
	{
		return <<<EOD
		<div class="alert alert-$messageType alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            $text
        </div>

EOD;

	}

	// simplified functions
	
	public static function Profile($object)
	{
		if ($profiles = $object->profiles())
		{
			$profile = $object->profile();
			if (isset($profile->id) && !$profile->id) $profile->id = 0;
			return JForm::Select2('Profile__id', $profile, array('elements' => (array('0' => trans('backend.null')) +  $profiles), 'label' => trans('backend.profile.title')));
		}
	}

}

