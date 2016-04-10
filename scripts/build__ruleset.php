<?php

function rulesetBuildKeys($keys, $config)
{
    $keys['rules'] = '';
    for ($i=1; $i<count($config['columns']); $i++) {
        $keys['rules'] .= "\n\t\t".'$this->addRule(';
        if (strpos(strrev($config['columns'][$i]['name']), 'di_') === 0) {
            $keys['rules'] .= '[\'type\'=>\'anyValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$config['table'].':'.$config['columns'][$i]['name'].'\'), \'field\'=>\''.$config['columns'][$i]['name'].'\', ]';
        } elseif ($config['columns'][$i]['type'] == 'string') {
            $keys['rules'] .= '[\'type\'=>\'lengthRange\', \'label\'=>lucid::i18n()->translate(\'model:'.$config['table'].':'.$config['columns'][$i]['name'].'\'), \'field\'=>\''.$config['columns'][$i]['name'].'\', \'min\'=>\'2\', \'max\'=>\'255\', ]';
        } elseif ($config['columns'][$i]['type'] == 'bool') {
            $keys['rules'] .= '[\'type\'=>\'checked\', \'label\'=>lucid::i18n()->translate(\'model:'.$config['table'].':'.$config['columns'][$i]['name'].'\'), \'field\'=>\''.$config['columns'][$i]['name'].'\', ]';
        } elseif ($config['columns'][$i]['type'] == 'int') {
            $keys['rules'] .= '[\'type\'=>\'integerValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$config['table'].':'.$config['columns'][$i]['name'].'\'), \'field\'=>\''.$config['columns'][$i]['name'].'\', ]';
        } elseif ($config['columns'][$i]['type'] == 'float') {
            $keys['rules'] .= '[\'type\'=>\'floatValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$config['table'].':'.$config['columns'][$i]['name'].'\'), \'field\'=>\''.$config['columns'][$i]['name'].'\', ]';
        } elseif ($config['columns'][$i]['type'] == 'timestamp') {
            $keys['rules'] .= '[\'type\'=>\'validDate\', \'label\'=>lucid::i18n()->translate(\'model:'.$config['table'].':'.$config['columns'][$i]['name'].'\'), \'field\'=>\''.$config['columns'][$i]['name'].'\', ]';
        } else {
            $keys['rules'] .= '[\'type\'=>\'anyValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$config['table'].':'.$config['columns'][$i]['name'].'\'), \'field\'=>\''.$config['columns'][$i]['name'].'\', ]';
        }
        $keys['rules'] .= ');';
    }
    return $keys;
}

function rulesetBuildFiles($keys, $config)
{
    buildFromTemplate('ruleset', $keys, $config['path'].'/app/ruleset/'.$config['table'].'.php');
}
