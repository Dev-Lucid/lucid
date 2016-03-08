<?php

class lucid_empty_object
{
    private $attributes = [];
    public function __construct($values)
    {
        $this->attributes = $values;
    }

    public function __get($name)
    {
        return (isset($this->attributes[$name]))?$this->attributes[$name]:'';
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}
