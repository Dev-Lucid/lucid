<?php

namespace DevLucid;

interface RequestInterface
{
    public function __construct($source);
    public function is_set($property);
    public function un_set($property);
    public function raw($property, $default_value);
    public function string($property, $default_value);
    public function int($property, $default_value);
    public function integer($property, $default_value);
    public function float($property, $default_value);
    public function bool($property, $default_value, $allow_string_on, $allow_string_true, $allow_string_1);
    public function boolean($property, $default_value, $allow_string_on, $allow_string_true, $allow_string_1);
    public function set($name, $new_value);
    public function get_array();
}
