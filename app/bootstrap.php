<?php
use \PHPWay\Router;
use \PHPWay\Response;

$routes = require_once APP_DIR.'/routes.php';
$router = new Router($_SERVER, $routes);

$result = $router->detect();


if (is_null($result)) // show 404 page 
{
	Response::show_404();
}
else
{
	list($callable, $params) = $result;
	$response = call_user_func_array($callable, $params);
	// process the response
	if (!($response instanceof Response))
	{
		$response = new Response($response);
	}
	$response->process();
}