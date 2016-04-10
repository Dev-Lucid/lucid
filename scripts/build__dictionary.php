<?php

function dictionaryBuildKeys($keys, $arguments)
{
    return $keys;
}

function dictionaryBuildFiles($keys, $config)
{
    $modelDictPath = $config['path'].'/app/dictionary/en__models.json';
    if (file_exists($modelDictPath)){
        $dictionaryKeys = json_decode(file_get_contents($modelDictPath), true);
    } else {
        $dictionaryKeys = [];
    }

    if (isset($dictionaryKeys['model:'.$config['table']]) === false) {
        $dictionaryKeys['model:'.$config['table']] = ucwords($config['table']);
    }

    foreach ($config['columns'] as $column) {
        if (isset($dictionaryKeys['model:'.$config['table'].':'.$column['name']]) === false) {
            $dictionaryKeys['model:'.$config['table'].':'.$column['name']] = ucwords(str_replace('_', ' ', $column['name']));
        }
    }

    ksort($dictionaryKeys);

    file_put_contents($modelDictPath, json_encode($dictionaryKeys, JSON_PRETTY_PRINT));

    $navigationDictPath = $config['path'].'/app/dictionary/en__navigation.json';
    if (file_exists($modelDictPath)){
        $dictionaryKeys = json_decode(file_get_contents($navigationDictPath), true);
    } else {
        $dictionaryKeys = [];
    }

    if (isset($dictionaryKeys['navigation:'.$config['table'].'.view.table']) === false) {
        $dictionaryKeys['navigation:'.$config['table'].'.view.table'] = ucwords(str_replace('_', ' ', $config['table']));
    }

    ksort($dictionaryKeys);

    file_put_contents($navigationDictPath, json_encode($dictionaryKeys, JSON_PRETTY_PRINT));
}
