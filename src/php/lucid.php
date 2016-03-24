<?php
namespace Lucid;

class Lucid
{
    public    static $stage = 'unknown';
    public    static $basePath                       = null;
    protected static $components                     = [];
    protected static $componentInterfaceRequirements = [];

    public static function init()
    {
        static::$basePath = realpath(__DIR__.'/../../../../../');
        static::addRequireInterface('request',    'Lucid\\Component\\StoreInterface');
        static::addRequireInterface('session',    'Lucid\\Component\\StoreInterface');
        static::addRequireInterface('cookie',     'Lucid\\Component\\StoreInterface');
        static::addRequireInterface('mvc',        'Lucid\\Component\\MVCInterface');
        static::addRequireInterface('queue',      'Lucid\\Component\\QueueInterface');
        static::addRequireInterface('response',   'Lucid\\Component\\ResponseInterface');
        static::addRequireInterface('permissions','Lucid\\Component\\PermissionsInterface');
        static::addRequireInterface('logger',     'Psr\\Log\\LoggerInterface');
        static::addRequireInterface('i18n',       'Lucid\\Component\\I18nInterface');
        static::addRequireInterface('error',      'Lucid\\Component\\ErrorInterface');
    }

    public static function addRequireInterface(string $name, string $interface)
    {
        static::$components[$name] = null;
        static::$componentInterfaceRequirements[$name] = $interface;
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
        if ( isset(static::$componentInterfaceRequirements[$name]) === true) {
            $implements = class_implements($component);
            if (in_array(static::$componentInterfaceRequirements[$name], $implements) === false) {
                throw new \Exception('New component for '.$name.' does not implement the required interface: '.static::$componentInterfaceRequirements[$name]);
            }
        }
        static::$components[$name] = $component;
    }

    public static function setDefaults()
    {
        if (is_null(static::$components['request']) === true) {
            static::$components['request'] = new \Lucid\Component\Store\Store($_REQUEST);
        }
        if (is_null(static::$components['session']) === true) {
            session_start();
            static::$components['session'] = new \Lucid\Component\Store\Store($_SESSION);
        }
        if (is_null(static::$components['mvc']) === true) {
            static::$components['mvc'] = new \Lucid\Component\MVC\MVC();
            static::$components['mvc']->setPath('model',      static::$basePath.'/db/models/');
            static::$components['mvc']->setPath('view',       static::$basePath.'/app/views/');
            static::$components['mvc']->setPath('controller', static::$basePath.'/app/controllers/');
        }
        if (is_null(static::$components['queue']) === true) {
            static::$components['queue'] = new \Lucid\Component\Queue\Queue();
        }
        if (is_null(static::$components['response']) === true) {
            static::$components['response'] = new \Lucid\Component\Response\Json();
        }
    }
}