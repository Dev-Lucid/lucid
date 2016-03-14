<?php

namespace DevLucid;

interface SessionInterface extends \Iterator
{
    public function __isset($property);
    public function __unset($property);
    public function __get($property);
    public function __call($property, $parameters);
    public function __set($property, $new_value);
    public function get($property, $default_value);
    public function set($property, $new_value);
    public function get_array();
    public function set_array($value_array);
    public function restart();
}