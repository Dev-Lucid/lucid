<?php

function modelBuildKeys($table, $columns, $keys, $arguments)
{
    echo("Building model keys\n");
    return $keys;
}

function modelBuildFiles($table, $columns, $keys, $arguments)
{
    echo("Building model files\n");
    buildFromTemplate('model', $keys, $arguments['appdir'].'/model/'.$table.'.php');
}
