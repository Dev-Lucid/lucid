<?php

class lucid
{
    public static $stage        = 'production';

    public static $logger       = null;
    public static $response     = null;
    public static $db           = null;
    public static $orm_function = null;
    public static $paths        = [];
    public static $libs         = [];

    public static $request         = null;
    public static $default_request = null;
    private static $actions         = [];

    public static $lang_major = 'en';
    public static $lang_minor = 'us';
    public static $lang_supported = ['en'];
    public static $lang_phrases = [];

    public static $scss_files = [];
    public static $scss_production_build = null;
    public static $scss_start_source = '';

    public static $js_files   = [];
    public static $js_production_build = null;

    public static function init($configs=[])
    {
        # set the default paths. These can be overridden in a config file
        lucid::$paths['base']  = realpath(__DIR__.'/../../../../../');
        lucid::$paths['lucid'] = realpath(__DIR__.'/../../');
        lucid::$paths['app']   = lucid::$paths['base'].'/app/';

        lucid::$paths['config']= [
            lucid::$paths['lucid'].'/config/',
            lucid::$paths['base'].'/config/',
        ];
        lucid::$paths['controllers'] = [
            lucid::$paths['lucid'].'/controllers/',
            lucid::$paths['app'].'controllers',
        ];
        lucid::$paths['views'] = [
            lucid::$paths['lucid'].'/views/',
            lucid::$paths['app'].'views/',
        ];
        lucid::$paths['dictionaries'] = [
            lucid::$paths['lucid'].'/dictionaries/',
            lucid::$paths['base'].'/dictionaries/',
        ];

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
        lucid::$libs[] = __DIR__.'/lucid_i18n.php';

        foreach($configs as $config){
            lucid::config($config);
        }

        foreach(lucid::$libs as $lib)
        {
            include($lib);
        }

        # setup the action request
        $action = lucid::$request['action'];
        unset(lucid::$request['action']);
        lucid::add_action('request', $action, lucid::$request);

        if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            $user_lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            # Some test strings
            # $user_lang = 'pt-br,pt;q=0.8,en-us;q=0.5,en,en-uk;q=0.3';
            # $user_lang = 'ja;q=0.8,de-de;q=0.3';
            lucid_i18n::determine_best_user_language($user_lang);
        }
        lucid_i18n::load_dictionaries();

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
                if (is_object(lucid::$logger))
                {
                    lucid::$logger->debug($text);
                }


            }
        }
    }

    public static function jslog($text)
    {
        $text = str_replace("'","\\'",$text);
        lucid::$response->javascript("console.log('".$text."');");
    }

    public static function config($name)
    {
        foreach(lucid::$paths['config'] as $config_path)
        {
            $file_name = $config_path.'/'.$name.'.php';
            if (file_exists($file_name))
            {
                include($file_name);
            }
        }
    }

    public static function controller($name)
    {
        $name = lucid::_clean_file_name($name);
        $class_name = 'lucid_controller_'.$name;

        # only bother to load if the class isn't already loaded.
        if(!class_exists($class_name))
        {
            foreach(lucid::$paths['controllers'] as $controller_path)
            {
                $file_name = $controller_path.'/'.$name.'.php';
                if (file_exists($file_name))
                {
                    include($file_name);
                }
            }
        }
        if(!class_exists($class_name))
        {
            throw new Exception('Unable to create controller: '.$name.'. Either no controller file was found, or the file did not contain a class named '.$class_name);
        }
        $new_obj = new $class_name();
        return $new_obj;
    }

    public static function view($name, $parameters=[])
    {
        $name = lucid::_clean_file_name($name);

        foreach(lucid::$paths['views'] as $view_path)
        {
            $file_name = $view_path.'/'.$name.'.php';
            if (file_exists($file_name))
            {
                foreach($parameters as $key=>$val)
                {
                    global $$key;
                    $$key = $val;
                }
                $result = include($file_name);
                foreach($parameters as $key=>$val)
                {
                    unset($GLOBALS[$key]);
                }
                return $result;
            }
        }
        throw new Exception('Unable to load view '.$file_name.', file does not exist');
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

    public static function add_phrases($phrases)
    {
        foreach($phrases as $key=>$value)
        {
            lucid::$lang_phrases[$key] = $value;
        }
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

        # 'view' is a special controller that just loads files. No reflection necessary
        if($controller_name == 'view'){
            lucid::log()->info($controller_name.'->'.$method.'()');
            return $controller->$method($passed_params);
        }

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
        return call_user_func_array( [$controller, $method],  $bound_params);
    }
}
