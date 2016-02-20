<?php

class lucid_controller
{
    public function __construct()
    {
    }
}

class lucid_controller_view extends lucid_controller
{
    public function __call($view_name,$parameters=[])
    {
        if(!isset($parameters[0]))
        {
            $parameters[0] = [];
        }
        return lucid::view($view_name,$parameters[0]);
    }
}
