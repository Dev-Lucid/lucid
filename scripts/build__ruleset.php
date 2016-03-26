<?php

function rulesetBuildKeys($table, $columns, $keys, $arguments)
{
    $keys['rules'] = '';
    for ($i=1; $i<count($columns); $i++) {
        $keys['rules'] .= "\n\t\t".'$this->addRule(';
        if (strpos(strrev($columns[$i]['name']), 'di_') === 0) {
            $keys['rules'] .= '[\'type\'=>\'anyValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$table.':'.$columns[$i]['name'].'\'), \'field\'=>\''.$columns[$i]['name'].'\', ]';
        } elseif ($columns[$i]['type'] == 'string') {
            $keys['rules'] .= '[\'type\'=>\'lengthRange\', \'label\'=>lucid::i18n()->translate(\'model:'.$table.':'.$columns[$i]['name'].'\'), \'field\'=>\''.$columns[$i]['name'].'\', \'min\'=>\'2\', \'max\'=>\'255\', ]';
        } elseif ($columns[$i]['type'] == 'bool') {
            $keys['rules'] .= '[\'type\'=>\'checked\', \'label\'=>lucid::i18n()->translate(\'model:'.$table.':'.$columns[$i]['name'].'\'), \'field\'=>\''.$columns[$i]['name'].'\', ]';
        } elseif ($columns[$i]['type'] == 'int') {
            $keys['rules'] .= '[\'type\'=>\'integerValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$table.':'.$columns[$i]['name'].'\'), \'field\'=>\''.$columns[$i]['name'].'\', ]';
        } elseif ($columns[$i]['type'] == 'float') {
            $keys['rules'] .= '[\'type\'=>\'floatValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$table.':'.$columns[$i]['name'].'\'), \'field\'=>\''.$columns[$i]['name'].'\', ]';
        } elseif ($columns[$i]['type'] == 'timestamp') {
            $keys['rules'] .= '[\'type\'=>\'validDate\', \'label\'=>lucid::i18n()->translate(\'model:'.$table.':'.$columns[$i]['name'].'\'), \'field\'=>\''.$columns[$i]['name'].'\', ]';
        } else {
            $keys['rules'] .= '[\'type\'=>\'anyValue\', \'label\'=>lucid::i18n()->translate(\'model:'.$table.':'.$columns[$i]['name'].'\'), \'field\'=>\''.$columns[$i]['name'].'\', ]';
        }
        $keys['rules'] .= ');';
    }
    return $keys;
}

function rulesetBuildFiles($table, $columns, $keys, $arguments)
{
    buildFromTemplate('ruleset', $keys, $arguments['appdir'].'/ruleset/'.$table.'.php');
}
