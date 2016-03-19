<?php

namespace DevLucid;

interface ResponseInterface
{
    public function title(string $title);
    public function description(string $description);
    public function keywords(string $keywords);
    public function data($key, $data);
    public function javascript(string $js, $runBefore);
    public function error(string $error);
    public function replace(string $area, $content);
    public function append(string $area, $content);
    public function prepend(string $area, $content);
    public function clear($areas=null);
    public function handleEscapedFragment();
    public function send();
}