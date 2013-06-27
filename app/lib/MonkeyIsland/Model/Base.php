<?php


namespace MonkeyIsland\Model;


class Base 
{
    protected $_properties = array();

    public function db($connection = 'default')
    {
        return \PHPWay\DB::connection($connection);
    }

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