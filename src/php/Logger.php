<?php

namespace DevLucid;

class Logger
{
    public function __construct()
    {

    }

    public function __call($type, $args)
    {
        error_log($type.': '.$args[0]);
    }
}
