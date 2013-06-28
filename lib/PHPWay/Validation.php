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
	
	/**
	 * Triggers the validation.
	 * 
	 * @return bool validation success.
	 */
	public function validate()
	{
		foreach ($this->rules as $field => $rules)
		{
			$this->validate_field($field, $rules);
		}
		
		return empty($this->_errors);
	}

	/**
	 * Fetches the validation errors if any.
	 * 
	 * @return array
	 */
	public function errors()
	{
		return $this->_errors;
	}
	
	/**
	 * Validates given field.
	 * 
	 * @param String $field name
	 * @param String $rules
	 */ 
	protected function validate_field($field, $rules)
	{
		// example rule required|unique,tablename,id
		if (isset($this->_errors[$field])) return false;
		$rules = explode('|', $rules);
		foreach ($rules as $rule)
		{
			$chunks = explode(",", $rule);
			$method = trim(array_shift($chunks));
			array_unshift($chunks, $field);
			call_user_func_array(array($this, "_{$method}"), $chunks);
		}
	}
	
	/**
	 * Checks if the field is present and that it is a non-empty or null value.
	 * 
	 * @param String $field name
	 * @return bool
	 */
	protected function _required($field)
	{
		if (isset($this->fields[$field]) and $this->fields[$field] !== '' and $this->fields[$field] !== NULL)
		{
			return true;
		} 
		else
		{
			$this->_errors[$field] = "{$field} is required";
			return false;
		}
	}
}