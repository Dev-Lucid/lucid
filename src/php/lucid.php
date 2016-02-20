<?php

class lucid
{
    public static $logger = null;
    public static $db     = null;

    public static function init()
    {
        $configs = func_get_args();
        foreach($configs as $config){
            include($config);
        }

        if(is_null(lucid::$logger)){
            error_log('logger is still null, instantiating default logger using psr-3 interface, output to error_log');
            lucid::$logger = new lucid_logger();
        }
    }

    public static function log($text = null)
    {
        if (is_null($text))
        {
            return lucid::$logger;
        }
        lucid::$logger->debug($text);
    }

    public static function test_call()
    {
        error_log('testing!');
    }
}

class lucid_logger
{
    public function __construct()
    {

    }

    public function __call($type,$args)
    {
        error_log($type.': '.$args[0]);
    }
}
