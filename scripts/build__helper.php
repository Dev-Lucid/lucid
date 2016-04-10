<?php

function helperBuildKeys($table, $columns, $keys, $arguments)
{
    return $keys;
}

function helperBuildFiles($table, $columns, $keys, $arguments)
{
    buildFromTemplate('helper', $keys, $arguments['appdir'].'/helper/'.$table.'.php');
}
