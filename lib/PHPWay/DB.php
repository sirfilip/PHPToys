<?php

namespace PHPWay;

class DB
{
    // Hols all connections. Acts as multitone
    private static $_connections = array();

    // Hold all connection configurations
    private static $_config = array();


    private function __construct(){}

    /**
     * Configures a connection.
     * 
     * @param String $connection_name
     * @param String $dsn
     */
    public static function config($connection_name, $dsn)
    {
        static::$_config[$connection_name] = $dsn;
    }

    /**
     * Fetches a named connection.
     * 
     * If the connection is not opened it opens a new connection
     * otherwise it reuses already opened connection.
     * 
     * Acts as multitone
     * 
     * @param String $connection_name defaults to 'default'
     * @return PDO connection
     */
    public static function connection($connection_name = 'default')
    {
        if (! isset(static::$_connections[$connection_name])) 
        {
            static::$_connections[$connection_name] = static::connect($connection_name);
        }

        return static::$_connections[$connection_name];
    }

    /**
     * Creates new pdo connection.
     * 
     * @param String $connection name
     * @return PDO connection
     */
    private static function connect($connection_name)
    {
        return new \PDO(static::$_config[$connection_name]);
    }
}