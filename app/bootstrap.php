<?php
use \PHPWay\Router;
use \PHPWay\Response;
use \PHPWay\DB;

DB::config('default', "sqlite:".PROJECT_DIR."/db/dev.db");


$routes = require_once APP_DIR.'/routes.php';
$router = new Router($_SERVER, $routes);

$route = $router->detect();


if (is_null($route)) // show 404 page 
{
	Response::show_404();
}
else
{
	list($callable, $params) = $route;
	$response = call_user_func_array($callable, $params);
	
    // process the response
	if (!($response instanceof Response))
	{
		$response = new Response($response);
	}
	$response->process();
}