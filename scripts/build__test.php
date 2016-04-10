<?php

function testBuildKeys($keys, $config)
{
    return $keys;
}

function testBuildFiles($keys, $config)
{
    buildFromTemplate('test', $keys, $config['path'].'/tests/'.$config['table'].'_Test.php');
}
