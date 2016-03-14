<?php

namespace DevLucid;



class Session implements SessionInterface
{
    public function __construct()
    {

    }

    function rewind()
    {
      return reset($_SESSION);
    }

    function current()
    {
      return current($_SESSION);
    }

    function key()
    {
      return key($_SESSION);
    }

    function next()
    {
      return next($_SESSION);
    }

    function valid() {
      return key($_SESSION) !== null;
    }

    public function __isset(string $property)
    {
        return isset($_SESSION[$property]);
    }

    public function __unset(string $property)
    {
        unset($_SESSION[$property]);
    }

    public function __get(string $property)
    {
        return $this->get($property);
    }

    public function __set(string $property, $newValue)
    {
        return $this->set($property, $newValue);
    }

    public function __call($property, $params)
    {
        if (count($params) == 0) {
            return $this->get($property);
        } else {
            return $this->set($property, $params[0]);
        }
    }

    public function get(string $name, $defaultValue = null)
    {
        return (isset($_SESSION[$name]))?$_SESSION[$name]:$defaultValue;
    }

    public function set(string $name, $newValue)
    {
        $_SESSION[$name] = $newValue;
        return $this;
    }

    public function setArray(array $newValues)
    {
        foreach ($newValues as $key=>$value) {
            $_SESSION[$key] = $value;
        }
    }

    public function getArray(): array
    {
        return $_SESSION;
    }

    public function restart()
    {
        foreach ($_SESSION as $key=>$value) {
            unset($_SESSION[$key]);
        }
        session_regenerate_id(true);
    }
}
