<?php

class lucid_logger
{
    public function __construct()
    {

    }

    public function __call($type, $args)
    {
        error_log($type.': '.$args[0]);
    }
}
