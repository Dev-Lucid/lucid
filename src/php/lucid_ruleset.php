<?php

class lucid_ruleset
{
    public $rules = [];
    public $name  = '';
    public static $_handlers = [];

    public function __construct ($rules)
    {
        $this->rules = $rules;
    }

    public function send ($form_name = 'edit')
    {
        foreach ($this->rules as $key=>$value) {
            $this->rules[$key]['message'] = __('validation:'.$this->rules[$key]['type'], $this->rules[$key]);
        }
        $js = 'lucid.ruleset.add(\''.$form_name.'\','.json_encode($this->rules).');';
        lucid::$response->javascript($js);
    }

    public function has_errors ($data = null)
    {
        if (is_null($data)) {
            $data = lucid::$request;
        } elseif(is_array($data)) {
            $data = new lucid_request($data);
        }
        lucid::log($data->get_array());
        $errors = [];
        foreach ($this->rules as $rule) {
            if (isset(lucid_ruleset::$_handlers[$rule['type']]) === true && is_callable(lucid_ruleset::$_handlers[$rule['type']]) === true) {
                $func = lucid_ruleset::$_handlers[$rule['type']];
                $result = $func($rule, $data);
                if ($result === false) {
                    if (isset($errors[$rule['label']]) === false) {
                        $errors[$rule['label']] = [];
                    }
                    $errors[$rule['label']][] = __('validation:'.$rule['type'],$rule);
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

    public function send_errors($data = null)
    {
        if(($errors = $this->has_errors($data)) == false)
        {
            lucid::log('no errors found');
            return;
        }
        lucid::log('attempting to build error response');
        lucid::$response->javascript('lucid.ruleset.showErrors(\''.lucid::$request->string('__form_name').'\','.json_encode($errors).');');
        lucid::$response->send();
    }

    public function check_parameters($passed_parameters)
    {
        # this function determines what the names of the parameters sent to the function calling this should have been
        # named, then rebuilds the numerically indexed array of parameters into an associative array,
        # and then calls send_errors.
        $caller =  debug_backtrace()[1];
        $r = new ReflectionMethod($caller['class'], $caller['function']);
        $function_parameters = $r->getParameters();

        $final_parameters = [];
        for ($i=0; $i<count($function_parameters); $i++) {
            $final_parameters[$function_parameters[$i]->name] = (isset($passed_parameters[$i]))?$passed_parameters[$i]:null;
        }
        return $this->send_errors($final_parameters);
    }

    public static function send_error($field, $msg = null)
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

lucid_ruleset::$_handlers['length_range'] = function ($rule, $data) {
    $rule['last_value'] = $data->string($rule['field']);
    return (strlen($rule['last_value']) >= $rule['min'] && strlen($rule['last_value']) < $rule['max']);
};
