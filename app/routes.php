<?php


return array(

	'GET /' => function() {
		return \PHPWay\Response::json(array('message' => 'It Works'));
	},

    'POST /echo' => function() {
        return \PHPWay\Response::json(\PHPWay\Input::json());
    } 
);