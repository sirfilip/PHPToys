<?php

namespace PHPWay;

class DB
{
    private static $_connections = array();

    private static $_config = array();


    private function __construct(){}

    public static function config($connection_name, $dsn)
    {
        static::$_config[$connection_name] = $dsn;
    }

    public static function connection($connection_name = 'default')
    {
        if (! isset(static::$_connections[$connection_name])) 
        {
            static::$_connections[$connection_name] = static::connect($connection_name);
        }

        return static::$_connections[$connection_name];
    }

    private static function connect($connection_name)
    {
        return new \PDO(static::$_config[$connection_name]);
    }
}