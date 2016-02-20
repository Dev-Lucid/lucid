<?php

class lucid_response
{
    public $data = [];
    public $default_position = null;
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

    public function replace($area, $content=null)
    {
        if(!isset($area) and !is_null($this->default_position)){
            $area = $this->default_position;
        }

        if(!isset($content) || is_null($content)){
            $content = ob_get_clean();
            ob_start();
        }

        $this->data['replace'][$area] = $content;
    }

    public function append($area, $content)
    {
        if(!isset($area) and !is_null($this->default_position)){
            $area = $this->default_position;
        }

        if(!isset($content)){
            $content = ob_get_clean();
            ob_start();
        }

        $this->data['append'][$area] = $content;
    }

    public function prepend($area, $content)
    {
        if(!isset($area) and !is_null($this->default_position)){
            $area = $this->default_position;
        }

        if(!isset($content)){
            $content = ob_get_clean();
            ob_start();
        }

        $this->data['prepend'][$area] = $content;
    }

    public function __call($area, $args)
    {
        if (isset($args[0])){
            $this->replace('#'.$area,$args[0]);
        }else{
            $this->replace('#'.$area);
        }
    }

    public function send()
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode($this->data);
        exit($output);
    }
}
