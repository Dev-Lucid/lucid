<?php

namespace DevLucid;

class ControllerError extends Controller implements ControllerInterface
{
    public function not_found_message($data)
    {
        lucid::log($data);
    }
}
