<?php

namespace DevLucid;

interface SessionInterface extends \Iterator
{
    public function __isset(string $property);
    public function __unset(string $property);
    public function __get(string $property);
    public function __call($property, $parameters);
    public function __set(string $property, $newValue);
    public function get(string $property, $defaultValue);
    public function set(string $property, $newValue);
    public function getArray(): array;
    public function setArray(array $newValues);
    public function restart();
}