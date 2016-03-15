<?php

namespace DevLucid;

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
    public static $ormFunction = null;
    public static $paths        = [];

    public static $request         = null;
    public static $default_request = null;
    public static $use_rewrite     = false;
    private static $actions        = [];

    public static $lang_supported = ['en'];

    public static $scssFiles = [];
    public static $scssProductionBuild = null;
    public static $scssStartSource = '';

    public static $jsFiles   = [];
    public static $jsProductionBuild = null;

    public static function init($configs=[])
    {
        lucid::$php = explode('.', PHP_VERSION);

        # this array contains errors that are caught before logging is initialized.
        $startupErrors = [];

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

        foreach($configs as $config) {
            try {
                lucid::config($config);
            } catch(Exception $e) {
                $startupErrors[] = $e;
            }
        }

        # if the configs did not instantiate a session object and place it into lucid::$session,
        # instantiate a basic one. Any class that replaces this must implement the i_lucid_session interface
        if (is_null(lucid::$session) === true) {
            lucid::$session = new Session();
        }

        if (in_array('DevLucid\\SessionInterface', class_implements(lucid::$session)) === false){
            throw new \Exception('For compatibility, any class that replaces lucid::$session must implement DevLucid\\SessionInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/SessionInterface.php');
        }

        # if the configs did not instantiate a security object and place it into lucid::$security,
        # instantiate a basic one. Any class that replaces this must implement the i_lucid_security interface
        if (is_null(lucid::$security) === true) {
            lucid::$security = new Security();
        }
        if (in_array('DevLucid\\SecurityInterface', class_implements(lucid::$security)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$security must implement DevLucid\\SecurityInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/SecurityInterface.php');
        }

        # if the configs did not instantiate an error object and place it into lucid::$error,
        # instantiate a basic one. Any class that replaces this must implement the i_lucid_error interface
        if (is_null(lucid::$error) === true) {
            lucid::$error = new Error();
        }
        if (in_array('DevLucid\\ErrorInterface', class_implements(lucid::$error)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$error must implement the DevLucid\\ErrorInterface interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/ErrorInterface.php');
        }

        # if the configs did not instantiate a response object and place it into lucid::$response,
        # instantiate the default one. Any class that replaces this must implement the i_lucid_response interface
        if (is_null(lucid::$response) === true) {
            lucid::$response = new Response();
        }
        if (in_array('DevLucid\\ResponseInterface', class_implements(lucid::$response)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$response must implement DevLucid\\ResponseInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/ResponseInterface.php');
        }

        # if the configs did not instantiate a request object and place it into lucid::$request,
        # instantiate the default one. Any class that replaces this must implement the i_lucid_request interface
        if (is_null(lucid::$request) === true) {
            lucid::$request = new Request();
        }
        if (in_array('DevLucid\\RequestInterface', class_implements(lucid::$request)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$request must implement DevLucid\\RequestInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/RequestInterface.php');
        }

        # if the configs did not instantiate a response object and place it into lucid::$response,
        # instantiate the default one. Any class that replaces this must implement the i_lucid_response interface
        if (is_callable('DevLucid\\_') === false) {
            if (is_null(lucid::$i18n) === true) {
                lucid::$i18n = new I18n();
            }
            if (in_array('DevLucid\\I18nInterface', class_implements(lucid::$i18n)) === false){
                throw new \Exception('For compatibility, any class that replaces lucid::$i18n must implement the DevLucid\\I18nInterface interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/I18nInterface.php');
            }
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) === true){
                lucid::$i18n->determineBestUserLanguage($_SERVER['HTTP_ACCEPT_LANGUAGE']);
                lucid::$i18n->loadDictionaries(lucid::$paths['dictionaries']);
            }

            function _($phrase, $parameters=[]) {
                return lucid::$i18n->translate($phrase, $parameters);
            }
        }

        # if the configs did not instantiate a psr-3-compatible logger and store it in lucid::$logger,
        # instantiate a basic one that sends all output to error_log
        if (is_null(lucid::$logger) === true) {
            lucid::$logger = new Logger();
        } elseif (in_array('Psr\\Log\\LoggerInterface', class_implements(lucid::$logger)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$logger must implement the Psr\\Log\\LoggerInterface.');;
        }

        # setup the action request
        #if (lucid::$use_rewrite === true) # figure out how to do this using php development server
        if (lucid::$request->string('action', false)) {
            $action = lucid::$request->string('action');
            lucid::$request->un_set('action');
            lucid::addAction('request', $action, lucid::$request->get_array());
        }

        # now that init is complete, send all errors that we caught to the Logger
        foreach ($startupErrors as $error) {
            lucid::$error->handle($error);
        }
    }

    private static function includeIfExists($file, $paths = null)
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
        if (is_null($text) === true) {
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
        $text = str_replace("'", "\\'", $text);
        lucid::$response->javascript("console.log('".$text."');");
    }

    public static function config($name)
    {
        return lucid::includeIfExists($name.'.php', lucid::$paths['config']);
    }

    public static function controller(string $name)
    {
        $class_name = 'DevLucid\\Controller'.$name;
        $name = lucid::cleanFileName($name);

        # only bother to load if the class isn't already loaded.
        if (class_exists($class_name) === false) {
            lucid::includeIfExists($name.'.php', lucid::$paths['controllers']);
        }
        if (class_exists($class_name) === false) {
            throw new \Exception('Unable to load controller: '.$name.'. Either no controller file was found, or the file did not contain a class named '.$class_name);
        }
        $new_obj = new $class_name();
        return $new_obj;
    }

    public static function view(string $name, $parameters=[])
    {
        lucid::log()->info('view->'.$name.'()');
        $name = lucid::cleanFileName($name);
        if (is_object($parameters) === true) {
            $parameters = $parameters->get_array();
        }

        foreach (lucid::$paths['views'] as $viewPath) {
            $fileName = $viewPath . $name . '.php';
            if (file_exists($fileName) === true) {
                foreach ($parameters as $key=>$val) {
                    global $$key;
                    $$key = $val;
                }
                $result = include($fileName);
                foreach ($parameters as $key=>$val) {
                    unset($GLOBALS[$key]);
                }
                return $result;
            }
        }
        throw new \Exception('Unable to load view '.$file_name.', file does not exist');
    }

    public static function requireParameters(string ...$names)
    {
        $notFound = [];
        foreach ($names as $name) {
            if (isset($GLOBALS[$name]) === false) {
                $notFound[] = $name;
            }
        }

        if (count($notFound) > 0) {
            $view = basename(debug_backtrace()[0]['file']);
            throw new \Exception('View '.basename($view, '.php').' requires the following unset parameters: ['.implode(', ', $notFound).']');
        }
    }

    private static function cleanFileName(string $name): string
    {
        $name = preg_replace('/[^a-z0-9_\-\/]+/i', '', $name);
        return $name;
    }

    private static function cleanFunctionName(string $name): string
    {
        $name = preg_replace('/[^a-z0-9_\-\s]+/i', '', $name);
        $name = str_replace('-', '_', $name);
        return $name;
    }

    public static function model(string $name, int $id=null, bool $setIdOnCreate = true)
    {
        if (is_callable(lucid::$ormFunction) === true) {
            $func = lucid::$ormFunction;
            $model = $func($name);

            if (is_null($id) === true) {
                return $model;
            }
            if (strval($id) == '0' || $id === false) {
                $model = $model->create();
                if ($setIdOnCreate === true) {
                    $class = get_class($model);
                    $idCol = $class::$_id_column;
                    $model->$idCol = 0;
                }
                return $model;
            } else {
                return $model->find_one($id);
            }
        } else {
            throw new \Exception('No ORM function defined');
        }
    }

    public static function processCommandLineAction($argv)
    {
        array_shift($argv);
        $action = array_shift($argv);
        $parameters = [];
        while (count($argv) > 0) {
            list($key, $value) = explode('=', array_shift($argv));
            $parameters[$key] = $value;
        }
        lucid::addAction('request', $action, $parameters);
    }

    public static function addAction($when, $controllerMethod, $parameters = [])
    {
        lucid::$actions[$when][] = [$controllerMethod, new Request($parameters)];
    }

    public static function processActions()
    {
        lucid::processActionList('pre');
        try {
            lucid::processActionList('request');
        } catch (Exception\Silent $e) {
            lucid::log('Exception: '.$e->getMessage());
        } catch (\Exception $e) {
            lucid::log('Exception: '.$e->getMessage());
        }

        lucid::processActionList('post');
    }

    private static function processActionList($name)
    {
        for ($i=0; $i<count(lucid::$actions[$name]); $i++) {
            lucid::callAction(lucid::$actions[$name][$i][0], lucid::$actions[$name][$i][1]);
        }
    }

    public static function callAction($action, $passedParameters=[])
    {
        list($controllerName, $method) = explode('.',$action);

        try {
            if ($controllerName == 'view') {
                # 'view' isn't a real controller
                return lucid::view($method, $passedParameters);
            } else {
                $controller = lucid::controller($controllerName);
                lucid::log()->info($controllerName.'->'.$method.'()');
                return $controller->_callMethodWithParameters($method, $passedParameters);
            }
        } catch(Exception\Silent $e) {
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
