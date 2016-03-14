<?php

namespace DevLucid;

interface ErrorInterface
{
    public function shutdown();
    public function handle($e, bool $send_message);
    public function notFound($data, string $replace_selector);
    public function permissionDenied(string $replace_selector);
    public function loginRequired(string $replace_selector);
}