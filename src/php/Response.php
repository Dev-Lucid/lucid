<?php

namespace DevLucid;


class Response implements ResponseInterface
{
    public $data = [];
    public $defaultPosition = null;
    public $defaultClear = [];

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

    public function title(string $title)
    {
        $this->data['title'] = $title;
    }

    public function description(string $description)
    {
        $this->data['description'] = $description;
    }

    public function keywords(string $keywords)
    {
        $this->data['keywords'] = $keywords;
    }

    public function data($key, $data)
    {
        $this->data['data'][$key] = $data;
    }

    public function javascript(string $js, $runBefore = false)
    {
        $this->data[ (($runBefore)?'pre':'post') . 'Javascript' ] .= $js;
    }

    public function error(string $msg)
    {
        $this->data['errors'][] = $msg;
    }

    public function replace(string $area, $content=null)
    {
        if (isset($area) === false and is_null($this->defaultPosition) === false) {
            $area = $this->defaultPosition;
        }

        if (isset($content) === false || is_null($content) === true) {
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content) === true) {
            $content = $content->__toString();
        }
        $this->data['replace'][$area] = $content;
    }

    public function append(string $area, $content=null)
    {
        if (isset($area) === false and is_null($this->defaultPosition) === false) {
            $area = $this->defaultPosition;
        }

        if (isset($content) === false) {
            $content = ob_get_clean();
            ob_start();
        }

        if (is_object($content) === true) {
            $content = $content->__toString();
        }
        $this->data['append'][$area] = $content;
    }

    public function prepend(string $area, $content=null)
    {
        if (isset($area) === false and is_null($this->defaultPosition) === false) {
            $area = $this->defaultPosition;
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
            $this->replace('#'.$area, $args[0]);
        } else {
            $this->replace('#'.$area);
        }
    }

    public function clear($areas=null)
    {
        $areas = (is_null($areas) === true)?$this->defaultClear:$areas;
        $areas = (is_array($areas) === false)?[$areas]:$areas;
        foreach ($areas as $area) {
            $this->replace($area, '');
        }
    }

    public function handleEscapedFragment()
    {
        if (lucid::$request->is_set('_escaped_fragment_') === true) {

            $parameters = explode('|', lucid::$request->raw('_escaped_fragment_'));
            $action = array_shift($parameters);
            $passedParameters = [];

            for ($i=0; $i<count($parameters); $i+=2) {
                $passedParameters[$parameters[$i]] = $parameters[$i + 1];
            }

            lucid::$queue->add('request', $action, $passedParameters);
            lucid::$queue->process();

            $src = '<!DOCTYPE html><html lang="en"><head>';
            if (isset(lucid::$response->data['title']) === true) {
                $src .= '<title>'.lucid::$response->data['title'].'</title>';
            }
            if (isset(lucid::$response->data['keywords']) === true) {
                $src .= '<meta name="keywords" content="'.lucid::$response->data['keywords'].'" />';
            }
            if (isset(lucid::$response->data['description']) === true) {
                $src .= '<meta name="description" content="'.lucid::$response->data['description'].'" />';
            }
            $src .= '</head><body>';
            foreach (lucid::$response->data['replace'] as $key=>$value) {
                $src .= '<div data-key="'.$key.'">'.$value.'</div>';
            }
            $src .= '</body></html>';
            exit($src);
        }
    }

    public function send($status='success')
    {
        ob_clean();
        header('Content-Type: application/json');
        $output = json_encode(['status'=>$status, 'data'=>$this->data], JSON_PRETTY_PRINT);
        exit($output);
    }
}
