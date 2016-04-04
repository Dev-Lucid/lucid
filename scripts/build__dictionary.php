<?php

function dictionaryBuildKeys($table, $columns, $keys, $arguments)
{
    return $keys;
}

function dictionaryBuildFiles($table, $columns, $keys, $arguments)
{
    $modelDictPath = $arguments['appdir'].'/dictionary/en__models.json';
    if (file_exists($modelDictPath)){
        $dictionaryKeys = json_decode(file_get_contents($modelDictPath), true);
    } else {
        $dictionaryKeys = [];
    }

    if (isset($dictionaryKeys['model:'.$table]) === false) {
        $dictionaryKeys['model:'.$table] = ucwords($table);
    }

    foreach ($columns as $column) {
        if (isset($dictionaryKeys['model:'.$table.':'.$column['name']]) === false) {
            $dictionaryKeys['model:'.$table.':'.$column['name']] = ucwords(str_replace('_', ' ', $column['name']));
        }
    }

    ksort($dictionaryKeys);

    file_put_contents($modelDictPath, json_encode($dictionaryKeys, JSON_PRETTY_PRINT));

    $navigationDictPath = $arguments['appdir'].'/dictionary/en__navigation.json';
    if (file_exists($modelDictPath)){
        $dictionaryKeys = json_decode(file_get_contents($navigationDictPath), true);
    } else {
        $dictionaryKeys = [];
    }

    if (isset($dictionaryKeys['navigation:'.$table.'.view.table']) === false) {
        $dictionaryKeys['navigation:'.$table.'.view.table'] = ucwords(str_replace('_', ' ', $table));
    }

    ksort($dictionaryKeys);

    file_put_contents($navigationDictPath, json_encode($dictionaryKeys, JSON_PRETTY_PRINT));
}
