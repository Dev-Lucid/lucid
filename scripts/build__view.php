<?php

function viewBuildKeys($table, $columns, $keys, $arguments)
{
    echo("Building view keys\n");
    return $keys;
}

function viewBuildFiles($table, $columns, $keys, $arguments)
{
    echo("Building view files\n");
    buildFromTemplate('view', $keys, $arguments['appdir'].'/view/'.$table.'.php');
}
