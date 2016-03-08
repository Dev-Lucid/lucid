<?php

interface i_lucid_response
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
    public function send();

}

class lucid_response implements i_lucid_response
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
        if(!isset($area) and !is_null($this->default_position)){
            $area = $this->default_position;
        }

        if(!isset($content) || is_null($content)){
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content))
        {
            $content = $content->__toString();
        }
        $this->data['replace'][$area] = $content;
    }

    public function append($area, $content=null)
    {
        if(!isset($area) and !is_null($this->default_position)){
            $area = $this->default_position;
        }

        if(!isset($content)){
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content))
        {
            $content = $content->__toString();
        }
        $this->data['append'][$area] = $content;
    }

    public function prepend($area, $content=null)
    {
        if(!isset($area) and !is_null($this->default_position)){
            $area = $this->default_position;
        }

        if(!isset($content)){
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content))
        {
            $content = $content->__toString();
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
        $output = json_encode($this->data, JSON_PRETTY_PRINT);
        exit($output);
    }
}
