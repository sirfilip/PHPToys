<?php

namespace PHPWay;


class Validation
{
	private $fields;
	private $rules;
	private $_errors = array();
	
	public function __construct($fields, $rules)
	{
		$this->fields = $fields;
		$this->rules = $rules;
	}
	
	public function validate()
	{
		foreach ($this->rules as $field => $rules)
		{
			$this->validate_field($field, $rules);
		}
		
		return empty($this->_errors);
	}
	
	public function validate_field($field, $rules)
	{
		// example rule required|unique:tablename,id
		$rules = explode('|', $rules);
	}
	
	private function _required($field)
	{
		
	}
	
	private function _unique($field, $table, $id)
	{
		
	}
	
	private function _number($field)
	{
		
	}
}