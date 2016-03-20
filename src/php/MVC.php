<?php

namespace DevLucid;

class MVC implements MVCInterface
{
    protected function cleanFileName(string $name): string
    {
        $name = preg_replace('/[^a-z0-9_\-\/]+/i', '', $name);
        return $name;
    }

    protected function findFile(string $name, string $type)
    {
        $paths = lucid::$paths[$type];

        $name = $this->cleanFileName($name);
        if (is_array($paths) === false) {
            $paths = [$paths];
        }

        foreach ($paths as $path) {
            $fileName = $path . $name . '.php';
            if (file_exists($fileName) === true) {
                return $fileName;
            }
        }

        throw new \Exception('MVC loader failure, type='.$type.', name='.$name.', paths='.implode(', ',$paths).'. Check for typos.');
    }

    public function findModel(string $name)
    {
        return $this->findFile($name, 'models');
    }

    public function loadModel(string $name): string
    {
        $class = 'Model'.$name;

        if (class_exists($class) === false) {
            $fileName = $this->findModel($name);
            include($fileName);
        }

        if (class_exists($class) === false) {
            throw new \Exception('MVC model instantiation failure. File '.$fileName.' must contain a class named '.$class.' that inherits from Controller, and must be in the root namespace (NOT DevLucid).');
        }

        return $class;
    }

    public function model(string $name, $id=null)
    {
        $class = $this->loadModel($name);

        if (is_null($id) === true) {
            return \Model::factory($name);
        } else {
            if ($id == 0) {
                return \Model::factory($name)->create();
            } else {
                return \Model::factory($name)->find_one($id);
            }
        }
    }

    public function findView(string $name)
    {
        return $this->findFile($name, 'views');
    }

    public function loadView(string $name)
    {
        return include($this->findView($name));
    }

    public function view(string $name, $parameters=[])
    {
        $class = 'DevLucid\\View'.$name;

        $fileName = $this->findView($name);

        if (is_object($parameters) === true) {
            $arrayParameters = $parameters->get_array();
        } elseif(is_array($parameters)) {
            $arrayParameters = $parameters;
        } else {
            $arrayParameters = [];
        }

        lucid::log('here');

        foreach ($arrayParameters as $key=>$val) {
            global $$key;
            $$key = $val;
        }
        $result = include($fileName);
        foreach ($arrayParameters as $key=>$val) {
            unset($GLOBALS[$key]);
        }

        # if the view did NOT return content, but instead defined a view class, then
        # call its __construct method with the parameters bound, and then its render method
        if (class_exists($class) === true) {
            $boundParameters = $this->buildParameters($class, '__construct', $parameters);

            $view = new $class(...$boundParameters);
            if (in_array('DevLucid\\ViewInterface', class_implements($view)) === false) {
                throw new \Exception('Could not use view '.$name.'. For compatibility, a view class must implement DevLucid\\ViewInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/ViewInterface.php');
            }
            return $view->render();
        } else {
            return $result;
        }
    }

    public function findController(string $name)
    {
        return $this->findFile($name, 'controllers');
    }

    public function loadController(string $name): string
    {
        $class = 'DevLucid\\Controller'.$name;
        if (class_exists($class) === false) {
            $fileName = $this->findController($name);
            include($fileName);
        }
        if (class_exists($class) === false) {
            throw new \Exception('MVC controller instantiation failure. File '.$fileName.' must contain a class named '.$class.' that inherits from Controller, and must be in the DevLucid namespace.');
        }
        return $class;
    }

    public function controller(string $name)
    {
        $class = $this->loadController($name);
        lucid::log('about to instantiate '.$class);
        $object = new $class();
        return $object;
    }

    public function buildParameters($object, string $method, $parameters=[])
    {
        $objectClass = get_class($object);

        # we need to use the Request object's methods for casting parameters
        if(is_array($parameters) === true) {
            $parameters = new Request($parameters);
        }

        if (method_exists($objectClass, $method) === false) {
            throw new \Exception($objectClass.' does not contain a method named '.$method.'. Valid methods are: '.implode(', ', get_class_methods($objectClass)));
        }

        $r = new \ReflectionMethod($objectClass, $method);
        $methodParameters = $r->getParameters();

        # construct an array of parameters in the right order using the passed parameters
        $boundParameters = [];
        foreach ($methodParameters as $methodParameter) {
            $type = strval($methodParameter->getType());
            if ($parameters->is_set($methodParameter->name)) {
                if (is_null($type) === true || $type == '' || method_exists($parameters, $type) === false) {
                    $boundParameters[] = $parameters->raw($methodParameter->name);
                } else {
                    $boundParameters[] = $parameters->$type($methodParameter->name);
                }
            } else {
                if ($methodParameter->isDefaultValueAvailable() === true) {
                    $boundParameters[] = $methodParameter->getDefaultValue();
                } else {
                    throw new \Exception('Could not find a value to set for parameter '.$methodParameter->name.' of function '.$thisClass.'->'.$method.', and no default value was set.');
                }

            }
        }
        return $boundParameters;
    }
}
