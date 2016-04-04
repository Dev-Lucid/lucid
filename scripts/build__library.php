<?php

function libraryBuildKeys($table, $columns, $keys, $arguments)
{
    return $keys;
}

function libraryBuildFiles($table, $columns, $keys, $arguments)
{
    buildFromTemplate('library', $keys, $arguments['appdir'].'/library/'.$table.'.php');
}
