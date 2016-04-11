<?php

class Faq extends BaseModel {
	protected $fillable = array('question', 'answer', 'status'/*, 'order'*/);
	public static $map = array('question', 'answer', 'status'/*, 'order'*/);
	public static $translated_field = array('question', 'answer', 'status');
	public static $rules = array(
        'question' =>  'required',
        'answer' =>  'required',
        );

	public static $search_map = array(/*'order'*/);

	public function getAnswerAttribute($value)
	{
		return $this->formatter($value);
	}
}