<?php
namespace DevLucid;

class Queue implements QueueInterface
{
    protected $queues = [
        'pre'=>[],
        'request'=>[],
        'post'=>[],
    ];

    public function parseCommandLineAction()
    {
        array_shift($argv);
        $action = array_shift($argv);
        $parameters = [];
        while (count($argv) > 0) {
            list($key, $value) = explode('=', array_shift($argv));
            $parameters[$key] = $value;
        }
        $this->add('request', $action, $parameters);
    }

    public function parseRequestAction()
    {
        # setup the action request
        #if (lucid::$use_rewrite === true) # figure out how to do this using php development server
        if (lucid::$request->string('action', false) !== false) {
            $action = lucid::$request->string('action');
            lucid::$request->un_set('action');
            $this->add('request', $action, lucid::$request);
        }
    }

    public function add(string $when, string $action, $parameters = [])
    {
        if (isset($this->queues[$when]) === false) {
            $this->queues[$when] = [];
        }

        $this->queues[$when][] = [$action, $parameters];
    }

    public function process()
    {
        foreach ($this->queues as $when=>$queue) {
            foreach($queue as $item) {
                return $this->processItem($item[0], $item[1]);
            }
        }
    }

    public function processItem(string $action, $parameters=[])
    {
        $splitAction = explode('.', $action);
        if (count($splitAction) != 2) {
            throw new \Exception('Incorrect format for action: '.$action.'. An action must contain two parts, separated by a period. The leftside part is either a controller name or the word \'view\', and the rightside part is either a method of the controller, or the name of the view to load.');
        }
        $controllerName = $splitAction[0];
        $method         = $splitAction[1];

        try {
            if ($controllerName == 'view') {
                # 'view' isn't a real controller
                return lucid::$mvc->view($method, $parameters);
            } else {
                $controller = lucid::$mvc->controller($controllerName);
                lucid::log()->info($controllerName.'->'.$method.'()');
                return call_user_func_array([$controller, $method], lucid::$mvc->buildParameters($controller, $method, $parameters));
            }
        } catch(Exception\Silent $e) {
            lucid::log('Caught silent error: '.$e->getMessage());
            return;
        } catch(Exception $e) {
            lucid::$error->handle($e);
            return;
        }
    }
}
