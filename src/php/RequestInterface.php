<?php

namespace DevLucid;

interface RequestInterface
{
    public function __construct($source);
    public function is_set(string $property);
    public function un_set(string $property);
    public function raw(string $property, $defaultValueue);
    public function string(string $property, $defaultValueue);
    public function int(string $property, $defaultValueue);
    public function integer(string $property, $defaultValueue);
    public function float(string $property, $defaultValueue);
    public function bool(string $property, $defaultValueue, $allowStringOn, $allowStringTrue, $allowString1);
    public function boolean(string $property, $defaultValueue, $allowStringOn, $allowStringTrue, $allowString1);
    public function set(string $name, $new_value);
    public function get_array();
}
