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
    public static $use_rewrite     = false;
    private static $actions        = [];

    public static $lang_major = 'en';
    public static $lang_minor = 'us';
    public static $lang_supported = ['en'];
    public static $lang_phrases = [];

    public static $scss_files = [];
    public static $scss_production_build = null;
    public static $scss_start_source = '';

    public static $js_files   = [];
    public static $js_production_build = null;

    public static $error = null;
    public static $error_class = 'lucid_error';
    public static $error_phrase = 'page:custom_error:help';

    public static function init($configs=[])
    {
        # this array contains errors that are caught before logging is initialized.
        $startup_errors = [];

        # set the default paths. These can be overridden in a config file
        lucid::$paths['base']  = realpath(__DIR__.'/../../../../../');
        lucid::$paths['lucid'] = realpath(__DIR__.'/../../');
        lucid::$paths['app']   = lucid::$paths['base'].'/app';

        lucid::$paths['config']= [
            lucid::$paths['lucid'].'/config/',
            lucid::$paths['base']. '/config/',
        ];
        lucid::$paths['controllers'] = [
            lucid::$paths['lucid'].'/controllers/',
            lucid::$paths['app'].  '/controllers/',
        ];
        lucid::$paths['views'] = [
            lucid::$paths['lucid'].'/views/',
            lucid::$paths['app'].  '/views/',
        ];
        lucid::$paths['dictionaries'] = [
            lucid::$paths['lucid'].'/dictionaries/',
            lucid::$paths['base']. '/dictionaries/',
        ];

        lucid::$request =& $_REQUEST;
        lucid::$actions = [
            'pre'     => [],
            'request' => [],
            'post'    => [],
        ];

        # set the default libs to include. These can be overridden in a config file
        lucid::$libs[] = __DIR__.'/lucid_controller.php';
        lucid::$libs[] = __DIR__.'/lucid_model.php';
        lucid::$libs[] = __DIR__.'/lucid_response.php';
        lucid::$libs[] = __DIR__.'/lucid_logger.php';
        lucid::$libs[] = __DIR__.'/lucid_i18n.php';
        lucid::$libs[] = __DIR__.'/lucid_error.php';
        lucid::$libs[] = __DIR__.'/lucid_ruleset.php';
        lucid::$libs[] = __DIR__.'/lucid_rule.php';

        foreach($configs as $config)
        {
            try
            {
                lucid::config($config);
            }
            catch(Exception $e)
            {
                $startup_errors[] = $e;
            }
        }

        foreach(lucid::$libs as $lib)
        {
            try
            {
                include($lib);
            }
            catch(Exception $e)
            {
                $startup_errors[] = $e;
            }
        }

        # setup the action request
        #if (lucid::$use_rewrite === true) # figure out how to do this using php development server
        if (isset(lucid::$request['action']))
        {
            $action = lucid::$request['action'];
            unset(lucid::$request['action']);
            lucid::add_action('request', $action, lucid::$request);
        }

        # do language autodetect, and load all dictionaries for major/minor language
        try
        {
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
            {
                $user_lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
                # Some test strings
                # $user_lang = 'pt-br,pt;q=0.8,en-us;q=0.5,en,en-uk;q=0.3';
                # $user_lang = 'ja;q=0.8,de-de;q=0.3';
                lucid_i18n::determine_best_user_language($user_lang);
            }
            lucid_i18n::load_dictionaries();
        }
        catch(Exception $e)
        {
            $startup_errors[] = $e;
        }

        lucid::$response = new lucid_response();

        # if the configs did not instantiate a psr-3-compatible logger and store it in lucid::$logger,
        # instantiate a basic one that sends all output to error_log
        if(is_null(lucid::$logger)){
            lucid::$logger = new lucid_logger();
        }

        # startup error handling. Notably this class is replaceable with a custom class as long as it has a method named 'handle';
        if(class_exists(lucid::$error_class))
        {
            if (in_array('i_lucid_error',class_implements(lucid::$error_class)))
            {
                lucid::$error = new lucid::$error_class();
                register_shutdown_function([lucid::$error_class,'shutdown']);
            }
            else
            {
                throw new Exception('For compatibility, any class that replaces lucid_error must implement the i_lucid_error interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/lucid_error.php');
            }
        }

        # now that init is complete, send all errors that we caught to the Logger
        foreach($startup_errors as $error)
        {
            lucid::$error->handle($error);
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
        $class_name = 'lucid_controller_'.$name;
        $name = lucid::_clean_file_name($name);

        # only bother to load if the class isn't already loaded.
        if(!class_exists($class_name))
        {
            foreach(lucid::$paths['controllers'] as $controller_path)
            {
                $file_name = $controller_path.$name.'.php';
                if (file_exists($file_name))
                {
                    include($file_name);
                }
            }
        }
        if(!class_exists($class_name))
        {
            throw new Exception('Unable to load controller: '.$name.'. Either no controller file was found, or the file did not contain a class named '.$class_name);
        }
        $new_obj = new $class_name();
        return $new_obj;
    }

    public static function view($name, $parameters=[])
    {
        $name = lucid::_clean_file_name($name);

        foreach(lucid::$paths['views'] as $view_path)
        {
            $file_name = $view_path.$name.'.php';
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
            try
            {
                return $controller->$method($passed_params);
            }
            catch(Exception $e)
            {
                lucid::$error->handle($e);
                return;
            }
        }

        # using reflection, determine the name of each of the parameters of the method.
        try
        {
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
            try
            {
                return call_user_func_array( [$controller, $method],  $bound_params);
            }
            catch(Exception $e)
            {
                lucid::$error->handle($e);
            }
        }
        catch(Exception $e)
        {
            lucid::$error->handle($e);
        }
    }
}
