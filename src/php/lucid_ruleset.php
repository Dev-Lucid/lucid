<?php

class lucid_ruleset
{
    public $rules = [];
    public $name  = '';
    public static $_handlers = [];

    public function __construct($name, $rules)
    {
        $this->name = $name;
        $this->rules = $rules;
    }

    public function send()
    {
        foreach($this->rules as $key=>$value)
        {
            $this->rules[$key]['message'] = _('validation:'.$this->rules[$key]['type'],$this->rules[$key]);
        }
        $js = 'lucid.ruleset.add(\''.$this->name.'\','.json_encode($this->rules).');';
        lucid::$response->javascript($js);
    }

    public function has_errors($data = null)
    {
        if(is_null($data))
        {
            $data = lucid::$request;
        }
        $errors = [];
        foreach($this->rules as $rule)
        {
            if (isset(lucid_ruleset::$_handlers[$rule['type']]) and is_callable(lucid_ruleset::$_handlers[$rule['type']]))
            {
                $func = lucid_ruleset::$_handlers[$rule['type']];
                $result = $func($rule, $data);
                if ($result === false)
                {
                    if (!isset($errors[$rule['label']]))
                    {
                        $errors[$rule['label']] = [];
                    }
                    $errors[$rule['label']][] = _('validation:'.$rule['type'],$rule);
                }
            }
        }

        if (count($errors) > 0)
        {
            lucid::log('Validation failure: ');
            lucid::log($errors);
            return $errors;
        }
        return false;
    }

    public function send_errors()
    {
        if(($errors = $this->has_errors()) == false)
        {
            lucid::log('no errors found');
            return;
        }
        lucid::log('attempting to build error response');
        lucid::$response->javascript('lucid.ruleset.showErrors(\''.$this->name.'\','.json_encode($errors).');');
        lucid::$response->send();
    }

    public static function send_error($field, $msg)
    {
        $errors = [$field=>[$msg]];
        lucid::$response->javascript('lucid.ruleset.showErrors(\''.lucid::$request['__form_name'].'\','.json_encode($errors).');');
        lucid::$response->send();
    }
}

lucid_ruleset::$_handlers['length_range'] = function($rule, $data){
    $rule['last_value'] = strval($data[$rule['field']]);
    return (strlen($rule['last_value']) >= $rule['min'] && strlen($rule['last_value']) < $rule['max']);
};
