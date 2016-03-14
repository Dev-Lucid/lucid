<?php

namespace DevLucid;

class lucid_controller_error extends lucid_controller
{
    public function not_found_message($data)
    {
        lucid::log($data);
    }
}
