<?php
namespace Lucid;

class Lucid
{
    public static $app;

    public static function createApp()
    {
        include(__DIR__.'/AppFunction.php');
        
        Lucid::$app = new \Lucid\Component\Container\Container();
        Lucid::$app->requireInterfacesForIndex('config',     'Lucid\\Component\\Container\\ContainerInterface');
        Lucid::$app->requireInterfacesForIndex('request',    'Lucid\\Component\\Container\\ContainerInterface');
        Lucid::$app->requireInterfacesForIndex('session',    'Lucid\\Component\\Container\\ContainerInterface');
        Lucid::$app->requireInterfacesForIndex('cookie',     'Lucid\\Component\\Container\\ContainerInterface');
        Lucid::$app->requireInterfacesForIndex('factory',    'Lucid\\Component\\Factory\\FactoryInterface');
        Lucid::$app->requireInterfacesForIndex('router',     'Lucid\\Component\\Router\\RouterInterface');
        Lucid::$app->requireInterfacesForIndex('queue',      'Lucid\\Component\\Queue\\QueueInterface');
        Lucid::$app->requireInterfacesForIndex('response',   'Lucid\\Component\\Response\\ResponseInterface');
        Lucid::$app->requireInterfacesForIndex('permission', 'Lucid\\Component\\Permission\\PermissionInterface');
        Lucid::$app->requireInterfacesForIndex('logger',     'Psr\\Log\\LoggerInterface');
        Lucid::$app->requireInterfacesForIndex('i18n',       'Lucid\\Component\\I18n\\I18nInterface');

        Lucid::$app->set('config', new \Lucid\Component\Container\Container());
        Lucid::$app->config()->set('root', ($_SERVER['DOCUMENT_ROOT'] == '')?getcwd():realpath($_SERVER['DOCUMENT_ROOT'].'/../'));
        Lucid::$app->config()->set('stage', '');
    }

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

        if (static::$app->has('i18n') === false) {
            static::$app->set('i18n', new \Lucid\Component\I18n\I18n(new \Lucid\Component\Container\PrefixDecorator('i18n/', static::$app->config())));
            static::$app->i18n()->addAvailableLanguage('en', []);
            static::$app->i18n()->setLanguage('en');
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) === true) {
                static::$app->i18n()->parseLanguageHeader($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            }
            static::$app->i18n()->loadDictionaries(static::$app->config()->string('root').'/app/dictionary/');
        }

        if (static::$app->has('factory') === false) {
            $configDecorator = new \Lucid\Component\Container\PrefixDecorator('factory/', static::$app->config());
            $configDecorator->set('root', static::$app->config()->root());
            static::$app->set('factory', new \Lucid\Component\Factory\Factory(static::$app->logger(), $configDecorator, static::$app->i18n()));
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
    }

    public static function dumpConfig()
    {
        $config = static::$app->config()->getArray();
        $keys = array_keys($config);
        static::$app->logger()->debug('Current config:');
        static::$app->logger()->debug('----------------------------');
        foreach ($keys as $key) {
            if (is_string($config[$key]) === true) {
                static::$app->logger()->debug("(string) $key: ".$config[$key]);
            } elseif (is_numeric($config[$key]) === true) {
                static::$app->logger()->debug("(number) $key: ".$config[$key]);
            } elseif (is_bool($config[$key]) === true) {
                static::$app->logger()->debug("(bool) $key: ".(($config[$key] === true)?'true':'false'));
            } elseif (is_array($config[$key]) === true) {
                static::$app->logger()->debug("(array) $key: [".implode(',', array_keys($config[$key]))."]");
            } elseif (is_object($config[$key]) === true) {
                if(method_exists($config[$key], '__toString') === true) {
                    static::$app->logger()->debug("(".get_class($config[$key]).") $key: ".$config[$key]->__toString());
                } else {
                    static::$app->logger()->debug("(".get_class($config[$key]).") $key: <cannot convert>");
                }
            } else {
                static::$app->logger()->debug("(".getType($config[$key]).") $key: <cannot convert>");
            }
        }
    }
}
