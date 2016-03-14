<?php

namespace DevLucid;

interface ResponseInterface
{
    public function title($title);
    public function description($description);
    public function keywords($keywords);
    public function data($key, $data);
    public function javascript($js, $run_before);
    public function error($error);
    public function replace($area, $content);
    public function append($area, $content);
    public function prepend($area, $content);
    public function clear($areas=null);
    public function send();
}