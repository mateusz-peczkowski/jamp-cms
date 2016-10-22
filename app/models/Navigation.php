<?php

class Navigation extends BaseModel {
	protected $fillable = [];
	public static $has_tag = true;

	public function nodes()
	{
		return $this->hasMany('Node')->parent()->order();
	}
}