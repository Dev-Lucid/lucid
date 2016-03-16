<?php

namespace DevLucid;

interface RequestInterface
{
    public function __construct($source);
    public function is_set(string $property);
    public function un_set(string $property);
    public function raw(string $property, $defaultValue);
    public function string(string $property, $defaultValue);
    public function int(string $property, $defaultValue);
    public function integer(string $property, $defaultValue);
    public function float(string $property, $defaultValue);
    public function bool(string $property, $defaultValue, $allowStringOn, $allowStringTrue, $allowString1);
    public function boolean(string $property, $defaultValue, $allowStringOn, $allowStringTrue, $allowString1);
    public function DateTime(string $property, $defaultValue, $allowStringOn, $allowStringTrue, $allowString1);
    public function set(string $name, $new_value);
    public function get_array();
}
