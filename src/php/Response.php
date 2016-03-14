<?php

namespace DevLucid;


class Response implements ResponseInterface
{
    public $data = [];
    public $default_position = null;
    public $default_clears = ['#body', 'ul.nav2', '#full-width'];

    public function __construct()
    {
        ob_start();
        $this->data = [
            'title'=>null,
            'description'=>null,
            'keywords'=>null,
            'preJavascript'=>'',
            'postJavascript'=>'',
            'replace'=>[],
            'append'=>[],
            'prepend'=>[],
            'data'=>[],
            'errors'=>[],
        ];
    }

    public function title($title)
    {
        $this->data['title'] = $title;
    }

    public function description($description)
    {
        $this->data['description'] = $description;
    }

    public function keywords($keywords)
    {
        $this->data['keywords'] = $keywords;
    }

    public function data($key, $data)
    {
        $this->data['data'][$key] = $data;
    }

    public function javascript($js, $run_before = false)
    {
        $this->data[ (($run_before)?'pre':'post') . 'Javascript' ] .= $js;
    }

    public function error($msg)
    {
        $this->data['errors'][] = $msg;
    }

    public function replace($area, $content=null)
    {
        if (!isset($area) and !is_null($this->default_position)) {
            $area = $this->default_position;
        }

        if (!isset($content) || is_null($content)) {
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content)) {
            $content = $content->__toString();
        }
        $this->data['replace'][$area] = $content;
    }

    public function append($area, $content=null)
    {
        if (!isset($area) and !is_null($this->default_position)) {
            $area = $this->default_position;
        }

        if (!isset($content)) {
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content)) {
            $content = $content->__toString();
        }
        $this->data['append'][$area] = $content;
    }

    public function prepend($area, $content=null)
    {
        if (isset($area) === false and is_null($this->default_position) === false) {
            $area = $this->default_position;
        }

        if (isset($content) === false) {
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content) === true) {
            $content = $content->__toString();
        }
        $this->data['prepend'][$area] = $content;
    }

    public function __call($area, $args)
    {
        if (isset($args[0]) === true) {
            $this->replace('#'.$area,$args[0]);
        } else {
            $this->replace('#'.$area);
        }
    }

    public function clear($areas=null)
    {
        $areas = (is_null($areas) === true)?$this->default_clears:$areas;
        $areas = (is_array($areas) === false)?[$areas]:$areas;
        foreach ($areas as $area) {
            $this->replace($area,'');
        }
    }

    public function send()
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode($this->data, JSON_PRETTY_PRINT);
        exit($output);
    }
}
