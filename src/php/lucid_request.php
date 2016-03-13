<?php

interface i_lucid_request
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

class lucid_request implements i_lucid_request
{
    private $_source = null;

    public function __construct($source=null)
    {
        $this->_source = (is_null($source) === true)?$_REQUEST:$source;
    }

    public function is_set($property)
    {
        return isset($this->_source[$property]);
    }

    public function un_set($property)
    {
        unset($this->_source[$property]);
    }

    public function raw($name, $default_val = null)
    {
        return (isset($this->_source[$name]) === true)?$this->_source[$name]:$default_val;
    }

    public function string($name, $default_val=null)
    {
        return (isset($this->_source[$name]) === true)?strval($this->_source[$name]):$default_val;
    }

    public function int($name, $default_val=null)
    {
        if (isset($this->_source[$name]) === true) {
            if (is_numeric($this->_source[$name]) === false) {
                lucid::log()->warning('Data in request \''.$name.'\' was not numeric, but is being cast to a int. This will likely truncate the data to value 0. Are you sure this data should be a int?');
            }
            return intval($this->_source[$name]);
        } else {
            return $default_val;
        }
    }

    public function integer($name, $default_val=null)
    {
        return $this->int($name, $default_val);
    }

    public function float($name, $default_val=null)
    {
        if (isset($this->_source[$name]) === true) {
            if (is_numeric($this->_source[$name]) === false) {
                lucid::log()->warning('Data in request \''.$name.'\' was set and not numeric, but is being cast to a float. This will likely truncate the data to value 0. Are you sure this data should be a float?');
            }
            return floatval($this->_source[$name]);
        } else {
            return $default_val;
        }
    }

    public function bool($name, $default_val=null, $allow_string_on=true, $allow_string_true = true, $allow_string_1 = true)
    {
        $val = null;
        if (isset($this->_source[$name]) === true) {

            $val = false;
            if ($allow_string_on === true && strval($this->_source[$name]) === 'on') {
                $val = true;
            } elseif ($allow_string_true === true && strval($this->_source[$name]) === 'true') {
                $val = true;
            } elseif ($allow_string_1 === true && strval($this->_source[$name]) === '1') {
                $val = true;
            } elseif ($this->_source[$name] === true) {
                $val = true;
            }
        }

        if (is_null($val) === true) {
            $val = $default_val;
        }

        return $val;
    }

    public function boolean($name, $default_val=null, $allow_string_on=true, $allow_string_true = true, $allow_string_1 = true)
    {
        return $this->bool($name, $default_val, $allow_string_on, $allow_string_true, $allow_string_1);
    }

    public function set($name, $new_value)
    {
        $this->_source[$name] = $new_value;
        return $this;
    }

    public function get_array()
    {
        return $this->_source;
    }
}
