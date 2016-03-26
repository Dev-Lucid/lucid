<?php

function modelBuildKeys($table, $columns, $keys, $arguments)
{
    return $keys;
}

function modelBuildFiles($table, $columns, $keys, $arguments)
{
    buildFromTemplate('model', $keys, $arguments['appdir'].'/model/'.$table.'.php');
}
