<?php

namespace DevLucid;

class ErrorController extends Controller
{
    public function not_found_message($data)
    {
        lucid::log($data);
    }
}
