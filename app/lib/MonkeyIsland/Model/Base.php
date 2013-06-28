<?php


namespace MonkeyIsland\Model;


class Base 
{
    // object properties white list
    protected $_properties = array();

    /**
     * Fetches a named connection to the database
     * 
     * @param String $connection name
     * @return PDO connection
     */
    public function db($connection = 'default')
    {
        return \PHPWay\DB::connection($connection);
    }

    /**
     * Performs mass asignment protection
     * 
     * @param array $params
     * @return array $params filtered
     */
    protected function clean_params($params)
    {
        $data = array();
        foreach ($this->_properties as $key)
        {
            if (isset($params[$key])) $data[$key] = $params[$key];
        }

        return $data;
    }
}