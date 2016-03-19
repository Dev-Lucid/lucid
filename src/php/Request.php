<?php

namespace DevLucid;

class Request implements RequestInterface
{
    private $_source = null;

    public function __construct($source=null)
    {
        $this->_source = (is_null($source) === true)?$_REQUEST:$source;
    }

    public function is_set(string $property): bool
    {
        return isset($this->_source[$property]);
    }

    public function un_set(string $property)
    {
        unset($this->_source[$property]);
    }

    public function raw(string $name, $defaultValue = null)
    {
        return (isset($this->_source[$name]) === true)?$this->_source[$name]:$defaultValue;
    }

    public function string(string $name, $defaultValue=null): string
    {
        return (isset($this->_source[$name]) === true)?strval($this->_source[$name]):$defaultValue;
    }

    public function int(string $name, $defaultValue=null): int
    {
        if (isset($this->_source[$name]) === true) {
            if (is_numeric($this->_source[$name]) === false) {
                lucid::log()->warning('Data in request \''.$name.'\' was not numeric, but is being cast to a int. This will likely truncate the data to value 0. Are you sure this data should be a int?');
            }
            return intval($this->_source[$name]);
        } else {
            return $defaultValue;
        }
    }

    public function integer(string $name, $defaultValue=null): int
    {
        return $this->int($name, $defaultValue);
    }

    public function float(string $name, $defaultValue=null): float
    {
        if (isset($this->_source[$name]) === true) {
            if (is_numeric($this->_source[$name]) === false) {
                lucid::log()->warning('Data in request \''.$name.'\' was set and not numeric, but is being cast to a float. This will likely truncate the data to value 0. Are you sure this data should be a float?');
            }
            return floatval($this->_source[$name]);
        } else {
            return $defaultValue;
        }
    }

    public function bool(string $name, $defaultValue=null, $allowStringOn=true, $allowStringTrue = true, $allowString1 = true): bool
    {
        $val = null;
        if (isset($this->_source[$name]) === true) {

            $val = false;
            if ($this->_source[$name] === true) {
                $val = true;
            } elseif ($allowStringOn === true && strval($this->_source[$name]) === 'on') {
                $val = true;
            } elseif ($allowStringTrue === true && strval($this->_source[$name]) === 'true') {
                $val = true;
            } elseif ($allowString1 === true && strval($this->_source[$name]) === '1') {
                $val = true;
            }
        }

        if (is_null($val) === true) {
            $val = $defaultValue;
        }

        return $val;
    }

    public function boolean(string $name, $defaultValue=null, $allowStringOn=true, $allowStringTrue = true, $allowString1 = true): bool
    {
        return $this->bool($name, $defaultValue, $allowStringOn, $allowStringTrue, $allowString1);
    }

    public function DateTime(string $name, $defaultValue=null, $allowStringOn=true, $allowStringTrue = true, $allowString1 = true): \DateTime
    {
        $val = null;
        if (isset($this->_source[$name]) === true) {
            $val = \DateTime::createFromFormat('Y-m-d H:i', $this->_source[$name]);
        }
        return $val;
    }

    public function set(string $name, $new_value)
    {
        $this->_source[$name] = $new_value;
        return $this;
    }

    public function get_array(): array
    {
        return $this->_source;
    }
}
