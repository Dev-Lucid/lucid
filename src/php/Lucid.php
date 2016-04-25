<?php
namespace Lucid;

class Lucid
{
    public static $app;


    /*
    protected static $components         = [];
    protected static $requiredInterfaces = [];

    public static function addRequiredInterfaces(string $name, string ...$interfaces)
    {
        static::$requiredInterfaces[$name] = $interfaces;
    }

    public static function __callStatic($name, $args=[])
    {
        if (isset(static::$components[$name]) === false) {
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
    public static function _(...$params)
    {
        return static::i18n()->translate(...$params);
    }

    */
    public static function setMissingComponents()
    {
        if (static::$app->has('logger') === false) {
            static::$app->set('logger', new \Lucid\Component\BasicLogger\BasicLogger());
        }

        if (static::$app->has('request') === false) {
            static::$app->set('request', new \Lucid\Component\Container\RequestContainer());
        }

        if (static::$app->has('session') === false) {
            static::$app->set('session', new \Lucid\Component\Container\SessionContainer());
        }

        if (static::$app->has('cookie') === false) {
            static::$app->set('cookie', new \Lucid\Component\Container\CookieContainer());
        }

        if (static::$app->has('factory') === false) {
            $configDecorator = new \Lucid\Component\Container\PrefixDecorator('factory/', static::$app->config());
            $configDecorator->set('root', static::$app->config()->root());
            static::$app->set('factory', new \Lucid\Component\Factory\Factory(static::$app->logger(), $configDecorator));
        }

        if (static::$app->has('router') === false) {
            static::$app->set('router', new \Lucid\Component\Router\Router(new \Lucid\Component\Container\PrefixDecorator('router/', static::$app->config())));
        }

        if (static::$app->has('queue') === false) {
            static::$app->set('queue', new \Lucid\Component\Queue\Queue(static::$app->logger(), static::$app->router(), static::$app->factory()));
        }

        if (static::$app->has('response') === false) {
            static::$app->set('response', new \Lucid\Component\Response\JsonResponse());
        }

        if (static::$app->has('permission') === false) {
            static::$app->set('permission', new \Lucid\Component\Permission\Permission(new \Lucid\Component\Container\PrefixDecorator('permission/', static::$app->config()), static::$app->session()));
        }



        if (static::$app->has('i18n') === false) {
            static::$app->set('i18n', new \Lucid\Component\I18n\I18n(new \Lucid\Component\Container\PrefixDecorator('i18n/', static::$app->config())));
            static::$app->i18n()->addAvailableLanguage('en', []);
            static::$app->i18n()->setLanguage('en');
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) === true) {
                static::$app->i18n()->parseLanguageHeader($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            }
            static::$app->i18n()->loadDictionaries(static::$app->config()->string('root').'/app/dictionary/');
        }
    }


}

Lucid::$app = new \Lucid\Component\Container\Container();
Lucid::$app->requireInterfacesForIndex('config', 'Lucid\\Component\\Container\\ContainerInterface');
Lucid::$app->requireInterfacesForIndex('request', 'Lucid\\Component\\Container\\ContainerInterface');
Lucid::$app->requireInterfacesForIndex('session', 'Lucid\\Component\\Container\\ContainerInterface');
Lucid::$app->requireInterfacesForIndex('cookie', 'Lucid\\Component\\Container\\ContainerInterface');
Lucid::$app->requireInterfacesForIndex('factory', 'Lucid\\Component\\Factory\\FactoryInterface');
Lucid::$app->requireInterfacesForIndex('router', 'Lucid\\Component\\Router\\RouterInterface');
Lucid::$app->requireInterfacesForIndex('queue', 'Lucid\\Component\\Queue\\QueueInterface');
Lucid::$app->requireInterfacesForIndex('response', 'Lucid\\Component\\Response\\ResponseInterface');
Lucid::$app->requireInterfacesForIndex('permission', 'Lucid\\Component\\Permission\\PermissionInterface');
Lucid::$app->requireInterfacesForIndex('logger', 'Psr\\Log\\LoggerInterface');
Lucid::$app->requireInterfacesForIndex('i18n', 'Lucid\\Component\\I18n\\I18nInterface');

Lucid::$app->set('config', new \Lucid\Component\Container\Container());
Lucid::$app->config()->set('root', ($_SERVER['DOCUMENT_ROOT'] == '')?getcwd():realpath($_SERVER['DOCUMENT_ROOT'].'/../'));
Lucid::$app->config()->set('stage', '');
