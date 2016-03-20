<?php

namespace DevLucid;

class lucid
{
    public static $stage        = 'production';
    public static $php          = null;

    # these properties contain objects which must implement certain interfaces. They can be set by a
    # config file passed to lucid::init(), and if they are blank after all config files are loaded, then
    # a default object is instantiated.
    public static $mvc      = null; # must implement DevLucid\MVCInterface
    public static $queue    = null; # must implement DevLucid\QueueInterface
    public static $logger   = null; # must implement psr-3 logging
    public static $response = null; # must implement DevLucid\ResponseInterface
    public static $security = null; # must implement DevLucid\SecurityInterface
    public static $session  = null; # must implement DevLucid\SessionInterface
    public static $error    = null; # must implement DevLucid\ErrorInterface
    public static $i18n     = null; # must implement DevLucid\I18nInterface

    public static $error_phrase = 'page:custom_error:help';

    public static $db           = null;
    public static $db_stages    = [];
    public static $paths        = [];

    public static $request         = null;
    public static $default_request = null;
    public static $use_rewrite     = false;

    public static $lang_supported = ['en'];

    public static $scssFiles = [];
    public static $scssProductionBuild = null;
    public static $scssStartSource = '';

    public static $jsFiles   = [];
    public static $jsProductionBuild = null;

    public static function init(array $configs=[])
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

        foreach($configs as $config) {
            try {
                lucid::config($config);
            } catch(Exception $e) {
                $startupErrors[] = $e;
            }
        }

        # if the configs did not instantiate an mvc object and place it into lucid::$mvc,
        # instantiate a basic one. Any class that replaces this must implement DevLucid\MVCInterface
        if (is_null(lucid::$mvc) === true) {
            lucid::$mvc = new MVC();
        }
        if (in_array('DevLucid\\MVCInterface', class_implements(lucid::$mvc)) === false){
            throw new \Exception('For compatibility, any class that replaces lucid::$mvc must implement DevLucid\\MVCInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/MVCInterface.php');
        }

        # if the configs did not instantiate a queue object and place it into lucid::$queue,
        # instantiate a basic one. Any class that replaces this must implement DevLucid\QueueInterface
        if (is_null(lucid::$queue) === true) {
            lucid::$queue = new Queue();
        }
        if (in_array('DevLucid\\QueueInterface', class_implements(lucid::$queue)) === false){
            throw new \Exception('For compatibility, any class that replaces lucid::$queue must implement DevLucid\\QueueInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/QueueInterface.php');
        }

        # if the configs did not instantiate a session object and place it into lucid::$session,
        # instantiate a basic one. Any class that replaces this must implement DevLucid\SessionInterface
        if (is_null(lucid::$session) === true) {
            lucid::$session = new Session();
        }
        if (in_array('DevLucid\\SessionInterface', class_implements(lucid::$session)) === false){
            throw new \Exception('For compatibility, any class that replaces lucid::$session must implement DevLucid\\SessionInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/SessionInterface.php');
        }

        # if the configs did not instantiate a security object and place it into lucid::$security,
        # instantiate a basic one. Any class that replaces this must implement DevLucid\\SecurityInterface
        if (is_null(lucid::$security) === true) {
            lucid::$security = new Security();
        }
        if (in_array('DevLucid\\SecurityInterface', class_implements(lucid::$security)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$security must implement DevLucid\\SecurityInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/SecurityInterface.php');
        }

        # if the configs did not instantiate an error object and place it into lucid::$error,
        # instantiate a basic one. Any class that replaces this must implement DevLucid\\ErrorInterface
        if (is_null(lucid::$error) === true) {
            lucid::$error = new Error();
        }
        if (in_array('DevLucid\\ErrorInterface', class_implements(lucid::$error)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$error must implement the DevLucid\\ErrorInterface interface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/ErrorInterface.php');
        }

        # if the configs did not instantiate a response object and place it into lucid::$response,
        # instantiate the default one. Any class that replaces this must implement DevLucid\\ResponseInterface
        if (is_null(lucid::$response) === true) {
            lucid::$response = new Response();
        }
        if (in_array('DevLucid\\ResponseInterface', class_implements(lucid::$response)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$response must implement DevLucid\\ResponseInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/ResponseInterface.php');
        }

        # if the configs did not instantiate a request object and place it into lucid::$request,
        # instantiate the default one. Any class that replaces this must implement DevLucid\\RequestInterface
        if (is_null(lucid::$request) === true) {
            lucid::$request = new Request();
        }
        if (in_array('DevLucid\\RequestInterface', class_implements(lucid::$request)) === false) {
            throw new \Exception('For compatibility, any class that replaces lucid::$request must implement DevLucid\\RequestInterface. The definition for this interface can be found in '.lucid::$paths['lucid'].'/src/php/RequestInterface.php');
        }

        # if the configs did not instantiate an internationalization object and place it into lucid::$i18n,
        # instantiate the default one. Any class that replaces this must implement DevLucid\\I18nInterface
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

        # now that init is complete, send all errors that we caught to the Logger
        foreach ($startupErrors as $error) {
            lucid::$error->handle($error);
        }
    }

    private static function includeIfExists(string $file, $paths = null)
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
        if (is_object($text) === true || is_array($text) === true) {
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

    public static function jslog(string $text)
    {
        $text = str_replace("'", "\\'", $text);
        lucid::$response->javascript("console.log('".$text."');");
    }

    public static function config(string $name)
    {
        return lucid::includeIfExists($name.'.php', lucid::$paths['config']);
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

    public static function redirect(string $new_view)
    {
        lucid::$mvc->view($new_view);
        lucid::$response->javascript('lucid.updateHash(\'#!view.'.$new_view.'\');');
    }
}
