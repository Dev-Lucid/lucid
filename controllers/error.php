<?php

namespace DevLucid;

class lucid_controller_error extends Controller
{
    public function not_found_message($data)
    {
        lucid::log($data);
    }
}
