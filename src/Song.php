<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 09/04/2015
 * Time: 15:23
 */

namespace Music;


class Song
{
    private $data = array();

    public function __construct($data = array())
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->data[$key] = $value;
            }
        }
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return null;
    }
    
    public function __toString()
    {
        return json_encode($this->data);
    }
}