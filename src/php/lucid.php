<?php

class lucid
{
    public static $logger       = null;
    public static $response     = null;
    public static $db           = null;
    public static $orm_function = null;
    public static $paths        = [];
    public static $libs         = [];

    public static $request         = null;
    public static $default_request = null;
    private static $actions         = [];

    public static function init()
    {
        # set the default paths. These can be overridden in a config file
        lucid::$paths['app']         = realpath(__DIR__.'/../../../../../app/');
        lucid::$paths['controllers'] = lucid::$paths['app'].'/controllers';
        lucid::$paths['views']       = lucid::$paths['app'].'/views';
        lucid::$paths['models']      = realpath(__DIR__.'/../../../../../db/models/');

        lucid::$request =& $_REQUEST;
        lucid::$actions = [
            'pre' => [],
            'request' => [],
            'post' => [],
        ];

        # set the default libs to include. These can be overridden in a config file
        lucid::$libs[] = __DIR__.'/lucid_controller.php';
        lucid::$libs[] = __DIR__.'/lucid_model.php';
        lucid::$libs[] = __DIR__.'/lucid_response.php';
        lucid::$libs[] = __DIR__.'/lucid_logger.php';

        $configs = func_get_args();
        foreach($configs as $config){
            include($config);
        }

        foreach(lucid::$libs as $lib)
        {
            include($lib);
        }

        # setup the action request
        $action = lucid::$request['action'];
        unset(lucid::$request['action']);
        lucid::add_action('request', $action, lucid::$request);

        lucid::$response = new lucid_response();

        if(is_null(lucid::$logger)){
            error_log('Logger is still null, instantiating default logger using psr-3 interface, output to error_log');
            lucid::$logger = new lucid_logger();
        }
    }

    public static function log($text = null)
    {
        if (is_null($text))
        {
            return lucid::$logger;
        }
        # we can split objects/arrays into multiple lines using print_r and some exploding
        if (is_object($text) or is_array($text)){
            $text = print_r($text, true);
            $text = explode("\n",$text);
            foreach($text as $line)
            {
                lucid::log($line);
            }
        }else{
            $text = rtrim($text);
            if($text != ''){
                lucid::$logger->debug($text);
            }
        }
    }

    public static function jslog($text)
    {
        $text = str_replace("'","\\'",$text);
        lucid::$response->javascript("console.log('".$text."');");
    }

    public static function controller($name)
    {
        $name = lucid::_clean_file_name($name);
        $file_name = lucid::$paths['controllers'].'/'.$name.'.php';
        $class_name = 'lucid_controller_'.$name;

        # only bother to load if the class isn't already loaded.
        if(!class_exists($class_name))
        {
            if (file_exists($file_name))
            {
                include($file_name);
            }
        }
        if(!class_exists($class_name))
        {
            throw new Exception('Unable to create controller: '.$name.'. Either no controller file was found, or the file did not contain a class named '.$class_name);
        }
        $new_obj = new $class_name();
        return $new_obj;
    }

    public static function view($name)
    {
        $name = lucid::_clean_file_name($name);
        $file_name = lucid::$paths['views'].'/'.$name.'.php';
        if (file_exists($file_name))
        {
            return include($file_name);
        }
        else
        {
            throw new Exception('Unable to load view '.$file_name.', file does not exist');
        }
    }

    private static function _clean_file_name($name)
    {
        $name = preg_replace('/[^a-z0-9_-\s]+/i', '', $name);
        $name = str_replace('-','/',$name);
        $name = str_replace('_','/',$name);
        return $name;
    }

    private static function _clean_function_name($name)
    {
        $name = preg_replace('/[^a-z0-9_-\s]+/i', '', $name);
        $name = str_replace('-','_',$name);
        return $name;
    }

    public static function model($name)
    {
        if(is_callable(lucid::$orm_function)){
            $func = lucid::$orm_function;
            return $func($name);
        }else{
            throw new Exception('No orm function defined');
        }
    }

    public static function add_action($when, $controller_method, $parameters = [])
    {
        lucid::$actions[$when][] = [$controller_method, $parameters];
    }

    public static function process_actions()
    {
        lucid::process_action_list('pre');
        lucid::process_action_list('request');
        lucid::process_action_list('post');
    }

    private static function process_action_list($name)
    {
        for($i=0; $i<count(lucid::$actions[$name]); $i++){
            lucid::call_action(lucid::$actions[$name][$i][0], lucid::$actions[$name][$i][1]);
        }
    }

    public static function call_action($action, $passed_params=[])
    {
        list($controller_name, $method) = explode('.',$action);

        $controller = lucid::controller($controller_name);

        # using reflection, determine the name of each of the parameters of the method.
        $r = new ReflectionMethod(get_class($controller), $method);
        $params = $r->getParameters();

        # construct an array of parameters in the right order using the passed parameters
        $bound_params = [];
        foreach($params as $param)
        {
            if (isset($passed_params[$param->name]))
            {
                $bound_params[] = $passed_params[$param->name];
            }
            else
            {
                $bound_params[] = null;
            }
        }

        # finally, call the controller method with the bound parameters
        lucid::log()->info($controller_name.'->'.$method.'()');
        call_user_func_array( [$controller, $method],  $bound_params);
    }
}
