<?php

interface i_lucid_session extends Iterator
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

class lucid_session implements i_lucid_session
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

    public function __isset($property)
    {
        return isset($_SESSION[$property]);
    }

    public function __unset($property)
    {
        unset($_SESSION[$property]);
    }

    public function __get($property)
    {
        return $this->get($property);
    }

    public function __set($property, $value)
    {
        return $this->set($property, $value);
    }

    public function __call($property, $params)
    {
        if(count($params) == 0)
        {
            return $this->get($property);
        }
        else
        {
            return $this->set($property, $params[0]);
        }
    }

    public function get($name, $default_val = null)
    {
        return (isset($_SESSION[$name]))?$_SESSION[$name]:$default_val;
    }

    public function set($name, $new_val)
    {
        $_SESSION[$name] = $new_val;
        return $this;
    }

    public function set_array($new_vals)
    {
        foreach($new_vals as $key=>$value)
        {
            $_SESSION[$key] = $value;
        }
    }

    public function get_array()
    {
        return $_SESSION;
    }

    public function restart()
    {
        foreach($_SESSION as $key=>$value)
        {
            unset($_SESSION[$key]);
        }
        session_regenerate_id(true);
    }
}
