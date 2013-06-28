<?php

namespace PHPWay;

class Input
{

    /**
     * Fetches and parses a json request body.
     * 
     * @return array json_decoded string
     */
    public static function json()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

}