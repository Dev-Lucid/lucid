<?php

namespace DevLucid;

class Controller
{
    public function __construct()
    {
    }

    public function _callMethodWithParameters(string $method, Request $passedParameters)
    {
        $thisClass = get_class($this);

        if (strpos($method, '_') === 0) {
            throw new \Exception('Cannot call method of controller starting with an underscore via requests. If you absolutely need to call such a method, write a method in the controller whose name does not start with an underscore and call the original method from that. This functionality allows you to mark methods as non-callable from requests simply by starting their name with an underscore.');
        }

        if (method_exists($this, $method) === false) {
            throw new \Exception(get_class($this).' does not contain a method named '.$method.'. Valid methods are: '.implode(', ', get_class_methods($this)));
        }

        $r = new \ReflectionMethod($thisClass, $method);
        $methodParameters = $r->getParameters();

        # construct an array of parameters in the right order using the passed parameters
        $boundParameters = [];
        foreach ($methodParameters as $methodParameter) {
            if (lucid::$php[0] < 7) {
                $type = null;
            } else {
                $type = strval($methodParameter->getType());
            }

            if ($passedParameters->is_set($methodParameter->name)) {
                if (is_null($type) === true || $type == '') {
                    $boundParameters[] = $passedParameters->raw($methodParameter->name);
                } else {
                    $boundParameters[] = $passedParameters->$type($methodParameter->name);
                }
            } else {
                if ($methodParameter->isDefaultValueAvailable() === true) {
                    $boundParameters[] = $methodParameter->getDefaultValue();
                } else {
                    throw new \Exception('Could not find a value to set for parameter '.$methodParameter->name.' of function '.$thisClass.'->'.$method.', and no default value was set.');
                }

            }
        }

        # finally, call the controller method with the bound parameter
        return call_user_func_array([$this, $method],  $boundParameters);
    }
}
