<?php

namespace DevLucid;

class Ruleset
{
    public $rules = [];
    public $name  = '';
    public static $handlers = [];

    public function __construct (array $rules)
    {
        $this->rules = $rules;
    }

    public function send ($formName = 'edit')
    {
        foreach ($this->rules as $key=>$value) {
            $this->rules[$key]['message'] = _('validation:'.$this->rules[$key]['type'], $this->rules[$key]);
        }
        $js = 'lucid.ruleset.add(\''.$formName.'\', '.json_encode($this->rules).');';
        lucid::$response->javascript($js);
    }

    public function hasErrors ($data = null)
    {
        if (is_null($data)) {
            $data = lucid::$request;
        } elseif(is_array($data)) {
            $data = new Request($data);
        }

        $errors = [];
        foreach ($this->rules as $rule) {
            if (isset(Ruleset::$handlers[$rule['type']]) === true && is_callable(Ruleset::$handlers[$rule['type']]) === true) {
                $func = Ruleset::$handlers[$rule['type']];
                $result = $func($rule, $data);
                if ($result === false) {
                    if (isset($errors[$rule['label']]) === false) {
                        $errors[$rule['label']] = [];
                    }
                    $errors[$rule['label']][] = _('validation:'.$rule['type'],$rule);
                }
            }
        }

        if (count($errors) > 0) {
            lucid::log('Validation failure: ');
            lucid::log($errors);
            return $errors;
        }
        return false;
    }

    public function sendErrors($data = null)
    {
        if (($errors = $this->hasErrors($data)) == false){
            lucid::log('no errors found');
            return;
        }
        lucid::log('attempting to build error response');
        lucid::$response->javascript('lucid.ruleset.showErrors(\''.lucid::$request->string('__form_name').'\','.json_encode($errors).');');
        lucid::$response->send();
    }

    public function checkParameters(array $passedParameters)
    {
        # this function determines what the names of the parameters sent to the function calling this should have been
        # named, then rebuilds the numerically indexed array of parameters into an associative array,
        # and then calls sendErrors.
        $caller =  debug_backtrace()[1];
        $r = new \ReflectionMethod($caller['class'], $caller['function']);
        $functionParameters = $r->getParameters();

        $finalParameters = [];
        for ($i=0; $i<count($functionParameters); $i++) {
            $finalParameters[$functionParameters[$i]->name] = (isset($passedParameters[$i]))?$passedParameters[$i]:null;
        }
        return $this->sendErrors($finalParameters);
    }

    public static function sendError(string $field, $msg = null)
    {
        if (is_null($msg) === true) {
            $msg = $field;
            $field = '';
        }
        $errors = [$field=>[$msg]];
        lucid::$response->javascript('lucid.ruleset.showErrors(\''.lucid::$request->string('__form_name').'\', '.json_encode($errors).');');
        lucid::$response->send();
    }
}

Ruleset::$handlers['length_range'] = function (array $rule, $data) {
    $rule['last_value'] = $data->string($rule['field']);
    return (strlen($rule['last_value']) >= $rule['min'] && strlen($rule['last_value']) < $rule['max']);
};
