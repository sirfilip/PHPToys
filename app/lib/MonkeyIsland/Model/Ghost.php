<?php

namespace MonkeyIsland\Model;



class Ghost
{
    public function all()
    {
        $data = array();
        foreach (range(1, 10) as $index)
        {
            $data[] = array('id' => $index, 'name' => $this->generateRandomString(8));
        }
        return $data;
    }

    private function generateRandomString($length = 10) 
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}