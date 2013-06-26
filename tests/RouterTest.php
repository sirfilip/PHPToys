<?php

use \PHPWay\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{
	public function test_should_detect_the_right_route()
	{
		$routes = array(
			'GET /' => 'route one',
			'POST /' => 'route two',
			'GET /one/two/three' => 'route three',
		);
		
		$env = array(
			'PATH_INFO' => '/one/two/three',
			'REQUEST_METHOD' => 'GET'
		);
		
		$router = new Router($env, $routes);
		$result = $router->detect();
		$this->assertNotNull($result);
		$this->assertEquals('route three', $result[0]);
		$this->assertEquals(array(), $result[1]);
	}
	
	public function test_should_extract_the_correct_params()
	{
		$routes = array(
			'GET /user/(\d+)/post/(\d+)' => 'route one',
		);
		
		$env = array(
			'PATH_INFO' => '/user/12/post/34',
			'REQUEST_METHOD' => 'GET'
		);
		
		$router = new Router($env, $routes);
		$result = $router->detect();
		$this->assertEquals(array(12, 34), $result[1]);
	}
	
	public function test_should_match_a_route_with_trailing_slash()
	{
		$routes = array(
			'GET /one/two/three' => 'the route',
		);
		
		$env = array(
			'PATH_INFO' => '/one/two/three/',
			'REQUEST_METHOD' => 'GET'
		);
		
		$router = new Router($env, $routes);
		$result = $router->detect();
		$this->assertNotNull($result);
	}
}