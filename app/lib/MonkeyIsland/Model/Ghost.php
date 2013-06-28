<?php

namespace MonkeyIsland\Model;



class Ghost
{
    /**
     * Fetches 10 ghosts with random string names
     * @return array of ghosts
     */
    public function all()
    {
        $data = array();
        foreach (range(1, 10) as $index)
        {
            $data[] = array('id' => $index, 'name' => $this->generateRandomString(8));
        }
        return $data;
    }

    /**
     * Generates random string of given length
     * 
     * @param int $length
     * @return String random string
     */
    private function generateRandomString($length = 10) 
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}