<?php

class lucid
{
    public static $stage        = 'production';
    public static $php          = null;

    # these properties contain objects which must implement certain interfaces. They can be set by a
    # config file passed to lucid::init(), and if they are blank after all config files are loaded then
    # a default object is instantiated.
    public static $logger   = null; # must implement psr-3 logging
    public static $response = null; # must implement i_lucid_response
    public static $security = null; # must implement i_lucid_security
    public static $session  = null; # must implement i_lucid_session
    public static $error    = null; # must implement i_lucid_error
    public static $i18n     = null; # must implement i_lucid_i18n

    public static $error_phrase = 'page:custom_error:help';

    public static $db           = null;
    public static $db_stages    = [];
    public static $orm_function = null;
    public static $paths        = [];
    public static $libs         = [];

    public static $request         = null;
    public static $default_request = null;
    public static $use_rewrite     = false;
    private static $actions        = [];

    public static $lang_supported = ['en'];

    public static $scss_files = [];
    public static $scss_production_build = null;
    public static $scss_start_source = '';

    public static $js_files   = [];
    public static $js_production_build = null;

    public static function init($configs=[])
    {
        lucid::$php = explode('.', PHP_VERSION);

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

        lucid::$actions = [
            'pre'     => [],
            'request' => [],
            'post'    => [],
        ];

        lucid::$libs[] = __DIR__.'/lucid_controller.php';
        lucid::$libs[] = __DIR__.'/lucid_model.php';
        lucid::$libs[] = __DIR__.'/lucid_response.php';
        lucid::$libs[] = __DIR__.'/lucid_request.php';
        lucid::$libs[] = __DIR__.'/lucid_logger.php';
        lucid::$libs[] = __DIR__.'/lucid_i18n.php';
        lucid::$libs[] = __DIR__.'/lucid_error.php';
        lucid::$libs[] = __DIR__.'/lucid_ruleset.php';
        lucid::$libs[] = __DIR__.'/lucid_session.php';
        lucid::$libs[] = __DIR__.'/lucid_security.php';

        foreach (lucid::$libs as $lib) {
            try {
                lucid::include_if_exists($lib);
            } catch(Exception $e) {
                $startup_errors[] = $e;
            }
        }

        foreach($configs as $config) {
            try {
                lucid::config($config);
            } catch(Exception $e) {
                $startup_errors[] = $e;
            }
        }

        # if the configs did not instantiate a session object and place it into lucid::$session,
        # instantiate a basic one. Any class that replaces this must implement the i_lucid_session interface
        if (is_null(lucid::$session) === true) {
            lucid::$session = new lucid_session();
        }
        if (in_array('i_lucid_session', class_implements(lucid::$session)) === false){
            throw new Exception('For compatibility, any class that replaces lucid::$session must implement the i_lucid_session interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/lucid_session.php');
        }

        # if the configs did not instantiate a security object and place it into lucid::$security,
        # instantiate a basic one. Any class that replaces this must implement the i_lucid_security interface
        if( is_null(lucid::$security) === true) {
            lucid::$security = new lucid_security();
        }
        if (in_array('i_lucid_security', class_implements(lucid::$security)) === false) {
            throw new Exception('For compatibility, any class that replaces lucid::$security must implement the i_lucid_security interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/lucid_security.php');
        }

        # if the configs did not instantiate an error object and place it into lucid::$error,
        # instantiate a basic one. Any class that replaces this must implement the i_lucid_error interface
        if(is_null(lucid::$error) === true) {
            lucid::$error = new lucid_error();
        }
        if (in_array('i_lucid_error', class_implements(lucid::$error)) === false) {
            throw new Exception('For compatibility, any class that replaces lucid::$error must implement the i_lucid_error interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/lucid_error.php');
        }

        # if the configs did not instantiate a response object and place it into lucid::$response,
        # instantiate the default one. Any class that replaces this must implement the i_lucid_response interface
        if (is_null(lucid::$response) === true) {
            lucid::$response = new lucid_response();
        }
        if (in_array('i_lucid_response', class_implements(lucid::$response)) === false) {
            throw new Exception('For compatibility, any class that replaces lucid::$response must implement the i_lucid_response interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/lucid_response.php');
        }

        # if the configs did not instantiate a request object and place it into lucid::$request,
        # instantiate the default one. Any class that replaces this must implement the i_lucid_request interface
        if (is_null(lucid::$request) === true){
            lucid::$request = new lucid_request();
        }
        if (in_array('i_lucid_request', class_implements(lucid::$request)) === false) {
            throw new Exception('For compatibility, any class that replaces lucid::$request must implement the i_lucid_request interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/lucid_request.php');
        }

        # if the configs did not instantiate a response object and place it into lucid::$response,
        # instantiate the default one. Any class that replaces this must implement the i_lucid_response interface
        if (is_callable('__') === false) {
            if (is_null(lucid::$i18n) === true) {
                lucid::$i18n = new lucid_i18n();
            }
            if (in_array('i_lucid_i18n', class_implements(lucid::$i18n)) === false){
                throw new Exception('For compatibility, any class that replaces lucid::$i18n must implement the i_lucid_i18n interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/lucid_i18n.php');
            }
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) === true){
                lucid::$i18n->determine_best_user_language($_SERVER['HTTP_ACCEPT_LANGUAGE']);
                lucid::$i18n->load_dictionaries(lucid::$paths['dictionaries']);
            }

            lucid::log('defining _()!');
            function __($phrase, $parameters=[])
            {
                return lucid::$i18n->translate($phrase, $parameters);
            }
        }

        # if the configs did not instantiate a psr-3-compatible logger and store it in lucid::$logger,
        # instantiate a basic one that sends all output to error_log
        if (is_null(lucid::$logger) === true) {
            lucid::$logger = new lucid_logger();
        }

        # setup the action request
        #if (lucid::$use_rewrite === true) # figure out how to do this using php development server
        if (lucid::$request->string('action', false)) {
            $action = lucid::$request->string('action');
            lucid::$request->un_set('action');
            lucid::add_action('request', $action, lucid::$request->get_array());
        }

        # now that init is complete, send all errors that we caught to the Logger
        foreach ($startup_errors as $error) {
            lucid::$error->handle($error);
        }
    }

    private static function include_if_exists($file, $paths = null)
    {
        if (is_null($paths) === true) {
            if (file_exists($file) === true) {
                include($file);
            }
        } elseif (is_array($paths) === true) {
            foreach ($paths as $path) {
                if (file_exists($path.$file) === true) {
                    include($path.$file);
                }
            }
        }
    }

    public static function log($text = null)
    {
        if (is_null($text) === true){
            return lucid::$logger;
        }

        # we can split objects/arrays into multiple lines using print_r and some exploding
        if (is_object($text) === true or is_array($text) === true) {
            $text = print_r($text, true);
            $text = explode("\n",$text);
            foreach ($text as $line) {
                lucid::log($line);
            }
        } else {
            $text = rtrim($text);
            if ($text != '') {
                if (is_object(lucid::$logger) === true) {
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
        return lucid::include_if_exists($name.'.php', lucid::$paths['config']);
    }

    public static function controller($name)
    {
        $class_name = 'lucid_controller_'.$name;
        $name = lucid::_clean_file_name($name);

        # only bother to load if the class isn't already loaded.
        if (class_exists($class_name) === false) {
            lucid::include_if_exists($name.'.php', lucid::$paths['controllers']);
        }
        if (class_exists($class_name) === false) {
            throw new Exception('Unable to load controller: '.$name.'. Either no controller file was found, or the file did not contain a class named '.$class_name);
        }
        $new_obj = new $class_name();
        return $new_obj;
    }

    public static function view($name, $parameters=[])
    {
        lucid::log()->info('view->'.$name.'()');
        $name = lucid::_clean_file_name($name);
        if (is_object($parameters) === true) {
            $parameters = $parameters->get_array();
        }

        foreach (lucid::$paths['views'] as $view_path) {
            $file_name = $view_path.$name.'.php';
            if (file_exists($file_name) === true) {
                foreach ($parameters as $key=>$val) {
                    global $$key;
                    $$key = $val;
                }
                $result = include($file_name);
                foreach ($parameters as $key=>$val) {
                    unset($GLOBALS[$key]);
                }
                return $result;
            }
        }
        throw new Exception('Unable to load view '.$file_name.', file does not exist');
    }

    private static function _clean_file_name($name)
    {
        $name = preg_replace('/[^a-z0-9_\-\/]+/i', '', $name);
        return $name;
    }

    private static function _clean_function_name($name)
    {
        $name = preg_replace('/[^a-z0-9_\-\s]+/i', '', $name);
        $name = str_replace('-','_',$name);
        return $name;
    }

    public static function model($name, $id=null, $set_id_on_create = true)
    {
        if(is_callable(lucid::$orm_function)){
            $func = lucid::$orm_function;
            $model = $func($name);

            if (is_null($id) === true) {
                return $model;
            }
            if (strval($id) == '0' || $id === false) {
                $model = $model->create();
                if ($set_id_on_create === true) {
                    $class = get_class($model);
                    $id_col = $class::$_id_column;
                    $model->$id_col = 0;
                }
                return $model;
            } else {
                return $model->find_one($id);
            }
        } else {
            throw new Exception('No ORM function defined');
        }
    }

    public static function process_command_line_action($argv)
    {
        array_shift($argv);
        $action = array_shift($argv);
        $parameters = [];
        while (count($argv) > 0) {
            list($key, $value) = explode('=', array_shift($argv));
            $parameters[$key] = $value;
        }
        lucid::add_action('request', $action, $parameters);
    }

    public static function add_action($when, $controller_method, $parameters = [])
    {
        lucid::$actions[$when][] = [$controller_method, new lucid_request($parameters)];
    }

    public static function process_actions()
    {
        lucid::process_action_list('pre');
        try {
            lucid::process_action_list('request');
        } catch (Lucid_Silent_Exception $e) {

        }

        lucid::process_action_list('post');
    }

    private static function process_action_list($name)
    {
        for ($i=0; $i<count(lucid::$actions[$name]); $i++) {
            lucid::call_action(lucid::$actions[$name][$i][0], lucid::$actions[$name][$i][1]);
        }
    }

    public static function call_action($action, $passed_params=[])
    {
        list($controller_name, $method) = explode('.',$action);

        try {
            if ($controller_name == 'view') {
                # 'view' isn't a real controller
                return lucid::view($method, $passed_params);
            } else {
                $controller = lucid::controller($controller_name);
                lucid::log()->info($controller_name.'->'.$method.'()');
                return $controller->_call_method_with_parameters($method, $passed_params);
            }
        } catch(Lucid_Silent_Exception $e) {
            lucid::log('Caught silent error: '.$e->getMessage());
            return;
        } catch(Exception $e) {
            lucid::$error->handle($e);
            return;
        }
    }

    public static function redirect($new_view)
    {
        lucid::view($new_view);
        lucid::$response->javascript('lucid.updateHash(\'#!view.'.$new_view.'\');');
    }
}
