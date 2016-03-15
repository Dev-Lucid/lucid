<?php

namespace DevLucid;

class ControllerError extends Controller
{
    public function not_found_message($data)
    {
        lucid::log($data);
    }
}
