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

    public function __construct()
    {
        $data = func_get_args();
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->data[$key] = $value;
            }
        } else {
            $this->data[] = $data;
        }
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }
}