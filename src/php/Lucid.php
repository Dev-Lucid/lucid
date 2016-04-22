<?php
namespace Lucid;

class Lucid
{
    protected static $components         = [];
    protected static $requiredInterfaces = [];

    public static function addRequiredInterfaces(string $name, string ...$interfaces)
    {
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
            foreach ($interfaces as $interface) {
                if (in_array($interface, $implements) === false) {
                    throw new \Exception('New component for '.$name.' does not implement a required interface. This component must implement the following interfaces: '.implode(', ',$interfaces));
                }
            }
        }
        static::$components[$name] = $component;
    }

    public static function setMissingComponents()
    {
        if (is_null(static::$components['logger']) === true) {
            static::setComponent('logger', new \Lucid\Component\BasicLogger\BasicLogger());
        }

        if (is_null(static::$components['request']) === true) {
            static::setComponent('request', new \Lucid\Component\Container\RequestContainer());
        }

        if (is_null(static::$components['session']) === true) {
            session_start();
            static::setComponent('session', new \Lucid\Component\Container\Container($_SESSION));
        }

        if (is_null(static::$components['cookie']) === true) {
            static::setComponent('cookie', new \Lucid\Component\Container\CookieContainer());
        }

        if (is_null(static::$components['factory']) === true) {
            static::setComponent('factory', new \Lucid\Component\Factory\Factory(static::logger(), static::config()));
        }

        if (is_null(static::$components['router']) === true) {
            static::setComponent('router', new \Lucid\Component\Router\Router());
        }

        if (is_null(static::$components['queue']) === true) {
            static::setComponent('queue', new \Lucid\Component\Queue\Queue(static::logger(), static::router(), static::factory()));
        }

        if (is_null(static::$components['response']) === true) {
            static::setComponent('response', new \Lucid\Component\Response\Json());
        }

        /*
        if (is_null(static::$components['error']) === true) {
            static::setComponent('error', new \Lucid\Component\Error\Error(static::logger()));
            static::error()->setReportingDirective(E_ALL);
            static::error()->setDebugStages('development');
            static::error()->registerHandlers();
        }
        */

        if (is_null(static::$components['permission']) === true) {
            static::setComponent('permission', new \Lucid\Component\Permission\Permission(static::session()));
        }

        if (is_null(static::$components['i18n']) === true) {
            static::setComponent('i18n', new \Lucid\Component\I18n\I18n());
            static::i18n()->addAvailableLanguage('en', []);
            static::i18n()->setLanguage('en');
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) === true) {
                static::i18n()->parseLanguageHeader($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            }
            static::i18n()->loadDictionaries(static::config()->string('root').'/app/dictionary/');
        }
    }

    public static function _(...$params)
    {
        return static::i18n()->translate(...$params);
    }
}

# only one component is added by default: config
Lucid::addRequiredInterfaces('config', 'Lucid\\Component\\Container\\ContainerInterface');
Lucid::setComponent('config', new \Lucid\Component\Container\Container());
Lucid::config()->set('root', ($_SERVER['DOCUMENT_ROOT'] == '')?getcwd():$_SERVER['DOCUMENT_ROOT']);
Lucid::config()->set('stage', '');

# these required interfaces are added now though, even if they're empty.
Lucid::addRequiredInterfaces('request',    'Lucid\\Component\\Container\\ContainerInterface');
Lucid::addRequiredInterfaces('session',    'Lucid\\Component\\Container\\ContainerInterface');
Lucid::addRequiredInterfaces('cookie',     'Lucid\\Component\\Container\\ContainerInterface');
Lucid::addRequiredInterfaces('factory',    'Lucid\\Component\\Factory\\FactoryInterface');
Lucid::addRequiredInterfaces('router',     'Lucid\\Component\\Router\\RouterInterface');
Lucid::addRequiredInterfaces('queue',      'Lucid\\Component\\Queue\\QueueInterface');
Lucid::addRequiredInterfaces('response',   'Lucid\\Component\\Response\\ResponseInterface');
Lucid::addRequiredInterfaces('permission', 'Lucid\\Component\\Permission\\PermissionInterface');
Lucid::addRequiredInterfaces('logger',     'Psr\\Log\\LoggerInterface');
Lucid::addRequiredInterfaces('i18n',       'Lucid\\Component\\I18n\\I18nInterface');