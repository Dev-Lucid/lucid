<?php

namespace DevLucid;

class Controller
{
    public function __construct()
    {
    }

    public function _call_method_with_parameters($method, $passed_parameters)
    {
        $this_class = get_class($this);

        if (strpos($method, '_') === 0) {
            throw new \Exception('Cannot call method of controller starting with an underscore via requests. If you absolutely need to call such a method, write a method in the controller whose name does not start with an underscore and call the original method from that. This functionality allows you to mark methods as non-callable from requests simply by starting their name with an underscore.');
        }

        $r = new \ReflectionMethod($this_class, $method);
        $method_parameters = $r->getParameters();

        # construct an array of parameters in the right order using the passed parameters
        $bound_parameters = [];
        foreach ($method_parameters as $method_parameter) {
            if (lucid::$php[0] < 7) {
                $type = null;
            } else {
                $type = strval($method_parameter->getType());
            }

            lucid::log('final type for parameter '.$method_parameter->name.' is: '.$type);

            if ($passed_parameters->is_set($method_parameter->name)) {
                if (is_null($type) === true || $type == '') {
                    $bound_parameters[] = $passed_parameters->raw($method_parameter->name);
                } else {
                    $bound_parameters[] = $passed_parameters->$type($method_parameter->name);
                }
            } else {
                if ($method_parameter->isDefaultValueAvailable() === true) {
                    $bound_parameters[] = $method_parameter->getDefaultValue();
                } else {
                    throw new \Exception('Could not find a value to set for parameter '.$method_parameter->name.' of function '.$this_class.'->'.$method.', and no default value was set.');
                }

            }
        }

        # finally, call the controller method with the bound parameter
        return call_user_func_array([$this, $method],  $bound_parameters);
    }
}
