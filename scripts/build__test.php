<?php

function testBuildKeys($table, $columns, $keys, $arguments)
{
    return $keys;
}

function testBuildFiles($table, $columns, $keys, $arguments)
{
    buildFromTemplate('test', $keys, $arguments['appdir'].'/../tests/'.$table.'.php');
}
