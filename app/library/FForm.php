<?php
class FForm
{
	public static function control ($control)
	{
		$type = $control->type;
		return self::$type($control);
	}

	protected static function text($control)
	{
		$id = "form_{$control->form->tag}_control_{$control->name}";
		$name = $control->name;
		$type = $control->type;
		$placeholder = $control->label;
		$required = $control->isRequired ? 'required' : '';
		return "<input id='{$id}' name='{$name}' type='{$type}' placeholder='{$placeholder}' {$required} />";
	}

	protected static function email($control)
	{
		$id = "form_{$control->form->tag}_control_{$control->name}";
		$name = $control->name;
		$type = $control->type;
		$placeholder = $control->label;
		$required = $control->isRequired ? 'required' : '';
		return "<input id='{$id}' name='{$name}' type='{$type}' placeholder='{$placeholder}' {$required} />";
	}

	protected static function textarea($control)
	{
		$id = "form_{$control->form->tag}_control_{$control->name}";
		$name = $control->name;
		$type = $control->type;
		$placeholder = $control->label;
		$required = $control->isRequired ? 'required' : '';

		return "<textarea id='{$id}' name='{$name}' placeholder='{$placeholder}' {$required}></textarea>";
	}

	protected static function select($control)
	{
		$id = "form_{$control->form->tag}_control_{$control->name}";
		$name = $control->name;
		$type = $control->type;
		$placeholder = $control->label;
		$required = $control->isRequired ? 'required' : '';

		$options = array();
		if ($control->values)
		{
			$values = explode(';', $control->values);
			foreach ($values as $value)
			{
				$options[] = "<option value='{$value}'>{$value}</option>";
			}
		}
		if ($options)
		{
			return "<select id='{$id}' name='{$name}'{$required}>" . implode('', $options) . "</select>";
		}

	}

	public static function button($form)
	{
		$text = trans('site.forms.' . $form->tag . '.button');
		return "<button class='btn-full btn-full--green' title='{$text}'>{$text}</button>";
	}

	public static function message()
	{
		return '<div class="ajax-message">
				<div class="alert alert-success" style="display: none;"></div>
			  	 <div class="alert alert-danger" style="display: none;"><ul></ul></div>
			</div>';
	}
}