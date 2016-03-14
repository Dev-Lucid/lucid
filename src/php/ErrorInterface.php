<?php

namespace DevLucid;

interface ErrorInterface
{
    public function build_error_string($e);
    public function shutdown();
    public function handle($e, $send_message);
    public function not_found($data);
    public function permission_denied($replace_selector);
    public function login_required($replace_selector);
}