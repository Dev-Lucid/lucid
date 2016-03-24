<?php
namespace Lucid;

class Lucid
{
    public static $stage                 = 'unknown';
    public static $path                  = null;
    protected static $components         = [];
    protected static $requiredInterfaces = [];

    public static function init()
    {
        static::$path = realpath(__DIR__.'/../../../../../');
        static::addRequiredInterfaces('request',    'Lucid\\Component\\Store\\StoreInterface');
        static::addRequiredInterfaces('session',    'Lucid\\Component\\Store\\StoreInterface');
        static::addRequiredInterfaces('cookie',     'Lucid\\Component\\Store\\StoreInterface');
        static::addRequiredInterfaces('mvc',        'Lucid\\Component\\MVC\\MVCInterface');
        static::addRequiredInterfaces('queue',      'Lucid\\Component\\Queue\\QueueInterface');
        static::addRequiredInterfaces('response',   'Lucid\\Component\\Response\\ResponseInterface');
        static::addRequiredInterfaces('permissions','Lucid\\Component\\Permissions\\PermissionsInterface');
        static::addRequiredInterfaces('logger',     'Psr\\Log\\LoggerInterface');
        static::addRequiredInterfaces('i18n',       'Lucid\\Component\\I18n\\I18nInterface');
        static::addRequiredInterfaces('error',      'Lucid\\Component\\Error\\ErrorInterface');
    }

    public static function addRequiredInterfaces(string $name, string ...$interfaces)
    {
        static::$components[$name] = null;
        static::$requiredInterfaces[$name] = $interfaces;
    }

    public static function __callStatic($name, $args=[])
    {
        if (isset(static::$components[$name]) === false || is_null(static::$components[$name]) === true) {
            throw new \Exception('Lucid does not currently contain a component named '.$name);
        }
        return static::$components[$name];
    }

    public static function setComponent(string $name, $component)
    {
        if ( isset(static::$requiredInterfaces[$name]) === true) {
            $interfaces = static::$requiredInterfaces[$name];
            $implements = array_keys(class_implements($component));
            #error_log('checking for required interfaces on '.$name.': '.print_r($interfaces, true));
            #error_log($name.' currently implements: '.print_r($implements, true));
            foreach ($interfaces as $interface) {
                if (in_array($interface, $implements) === false) {
                    throw new \Exception('New component for '.$name.' does not implement the required interface: '.$interface);
                }
            }
        }
        static::$components[$name] = $component;
    }

    public static function setDefaults()
    {
        if (is_null(static::$components['request']) === true) {
            static::setComponent('request', new \Lucid\Component\Store\Store($_REQUEST));
        }

        if (is_null(static::$components['session']) === true) {
            session_start();
            static::setComponent('session', new \Lucid\Component\Store\Store($_SESSION));
        }

        if (is_null(static::$components['cookie']) === true) {
            static::setComponent('cookie', new \Lucid\Component\Store\CookieStore());
        }

        if (is_null(static::$components['mvc']) === true) {
            static::setComponent('mvc', new \Lucid\Component\MVC\MVC());
            static::mvc()->setPath('model',      static::$path.'/app/models/');
            static::mvc()->setPath('view',       static::$path.'/app/views/');
            static::mvc()->setPath('controller', static::$path.'/app/controllers/');
            static::mvc()->setPath('library',    static::$path.'/app/libraries/');
        }

        if (is_null(static::$components['queue']) === true) {
            static::setComponent('queue', new \Lucid\Component\Queue\Queue());
        }

        if (is_null(static::$components['response']) === true) {
            static::setComponent('response', new \Lucid\Component\Response\Json());
        }

        if (is_null(static::$components['error']) === true) {
            static::setComponent('error', new \Lucid\Component\Error\Error());
            static::error()->setReportingDirective(E_ALL);
            static::error()->setDebugStages('development');
            static::error()->registerHandlers();
        }
    }
}