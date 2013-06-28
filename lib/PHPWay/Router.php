<?php

namespace PHPWay;

class Router 
{
	private $_path;
	private $_method;
	private $_routes;
	
	/**
	 * Router constructor.
	 * 
	 * Accepts $env and $routes array.
	 * 
	 * @param array $env
	 * @param array $routes
	 */
	public function __construct($env, $routes)
	{
		$this->_path = '/'.trim($env['PATH_INFO'], '/');
		$this->_method = $env['REQUEST_METHOD'];
		$this->_routes = $routes;
		$this->validate();
	}
	
	/**
	 * Detects a route based on the method and path.
	 * @return array of two elements (callback and params) or NULL if not found
	 */
	public function detect()
	{
		$matcher = "{$this->_method} {$this->_path}";
		foreach($this->_routes as $route => $callback)
		{
			$regex = "#^{$route}$#";
			if (preg_match($regex, $matcher, $matches))
			{
				array_shift($matches);
				return array($callback, $matches);
			}
		}
		
		return NULL;
	}
	
	/**
	 * Provides basic validation
	 */ 
	protected function validate()
	{
		if (! is_array($this->_routes)) throw new \Exception("Routes must be an array");
	}
}